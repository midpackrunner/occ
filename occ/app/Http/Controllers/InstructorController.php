<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateInstructorRequest;
use App\Instructor;
use App\Biography;
use Auth;

class InstructorController extends Controller
{
	/**
	 * Returns all instructors
	 *
	 */
	public function index() {
		// using scope in the model
		$instructors = Instructor::all();
		return view('instructors.index')->with('instructors', $instructors);
	}

	/**
	 * See RouteServiceProvider->boot for model binding.  Without binding
	 * you would need to have show($id), however, using binding, the $id key
	 * is replaced with the object itself.  This means, within this function
	 * you do not have to query the DB manually with:
	 * 
	 * 					$article = Article::findOrFail($id);
	 */
	public function show(Instructor $instructor) {

			// to debug -> dd($instructor)   , then return $instructor
			dd($instructor);
			return view('instructors.show')->with('instructor', $instructor);
	}

	public function create() {

		// to debug -> dd($article)   , then return $article
        /* if (Auth::guest()) {     //<- One way to go about it, but redundant
			return redirect('instructors');  //<- See constructor for middleware
		}*/
		return view('instructors.create');
	}

	/**
	 * See app/Requests/CreateArticleRequest for validation
	 *
	 */
	public function store(CreateInstructorRequest $request) {

		// validation: requires: title, body, and published_at

		// see Article class on how to control what can be passed
		// $article = new Article($request->all());
		// instructors()->save($article);
		$bio = new Biography($request->all());
		$bio->save();
		$instructor = new Instructor($request->all());
		$instructor->biography_id = $bio->id;
		$instructor->save();
		return redirect('instructors');
	}

	public function edit(Instructor $instructor) {

		return view('instructors.edit')->with('instructor', $instructor);
	}

	public function update(CreateInstructorRequest $request, $instructor) {

        $destinationPath = 'img/instructors/';
		$instructor->update($request->all());
		$instructor->save();
		$instructor_bio = $instructor->bio; 
        $fileName = $instructor->first_name . '_' . $instructor->last_name;
        if($request->hasFile('img_of_instructor')) {
            $request->file('img_of_instructor')->move($destinationPath, 
                                                $fileName);
            $instructor_bio->path_to_pic = $destinationPath . $fileName;
        	$this->handleImgFormat($instructor_bio->path_to_pic);
        } else {
            $instructor_bio->path_to_pic = '';
        }
		$instructor_bio->update($request->all());
		$instructor_bio->save();
		return redirect('instructors');
	}

	public function destroy(Instructor $instructor) {
		if(Auth::user()->role->type != 'admin') {
			return 'forbidden';
		}
		$bio = $instructor->bio;
		$bio->delete();
		$instructor->delete();
		return 'success';
	}

	private function handleImgFormat($path_to_img) {
		$thumb = new \Imagick();
		$thumb->readImage($path_to_img);
		$thumb->resizeImage(223,231,\Imagick::FILTER_LANCZOS,1);
		$thumb->writeImage($path_to_img);
		$thumb->clear();
		$thumb->destroy(); 
	}

	/**
	 * Public: Returns all instructors within the publish_at value
	 *
	 */
	public function instructor_bios() {
		// using scope in the model
		$instructors = Instructor::all();
		return view('instructors.instructor_bios')->with('instructors', $instructors);
	}
}
