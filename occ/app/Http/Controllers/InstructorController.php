<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateInstructorRequest;
use App\Instructor;
use App\Biography;
use App\User;
use App\Role;
use Auth;

class InstructorController extends Controller
{
	

    public function __construct() {
        $this->middleware('adminOrInstructor', ['except' =>['instructor_bios']]);
    }


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
		$emails = User::get(['id','email'])->toArray();
		foreach ($emails as $email) {
			$usr_emails[$email['id']] = $email['email'];
		}
		session()->flash('flash_message', 'A User Profile must be created first to select the proper email');
		return view('instructors.create', compact('usr_emails'));
	}

	/**
	 * See app/Requests/CreateInstructorRequest for validation
	 *
	 */
	public function store(CreateInstructorRequest $request) {

		$user = User::findOrFail($request->email);
		$user->roles_id = Role::where('type', 'instructor')->first()->id;
		$user->save();
		$bio = new Biography($request->all());
        if($request->hasFile('img_of_instructor')) {
        	$destinationPath = config('app.instructor_img_loc');
            $request->file('img_of_instructor')->move($destinationPath, 
                                                $fileName);
            $bio->path_to_pic = $destinationPath . $fileName;
        	$this->handleImgFormat($bio->path_to_pic);
        } else {
            $bio->path_to_pic = '';
        }
		$bio->save();
		$instructor = new Instructor($request->all());
		$instructor->biography_id = $bio->id;
		$instructor->user_id = $user->id;
		$instructor->save();
		return redirect('instructors');
	}

	public function edit(Instructor $instructor) {
		$emails = User::get(['id','email'])->toArray();
		foreach ($emails as $email) {
			$usr_emails[$email['id']] = $email['email'];
		}
		return view('instructors.edit', compact('instructor', 'usr_emails'));
	}

	/**
	 * Update an Instructor.  If the email has changed, then the user specified
	 * by the old email is set back to role="general".
	 *
	 */
	public function update(CreateInstructorRequest $request, $instructor) {
		// user email has changed
		if ($request->email != $instructor->user_id) {  
			$user = User::findOrFail($instructor->user_id);
			$user->roles_id = Role::where('type', 'general')->first()->id;
			$user->save();			
			$instructor->user_id = $request->email;
		}
        $destinationPath = config('app.instructor_img_loc');
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

	/**
	 * Return Roster view.  Handled by AdminRosterController.
	 *
	 */
	public function instructor_roster($user_id)
	{	

		$instructor = Instructor::where('user_id', $user_id)->first();
		return redirect()->action('Admin\AdminRosterController@roster', 
						['inst_filter' => $instructor->id, 'session_filter' => 'none',
						  'num_of_clm_hrs' => 0 , 'curr_page' => 1]);
	}

	private function handleImgFormat($path_to_img) {
		$thumb = new \Imagick();
		$thumb->readImage($path_to_img);
		$d = $thumb->getImageGeometry();
		$w = $d['width'];
		$h = $d['height'];
		$ratio = $h / $w;
		$h = 250 * $ratio;
		$thumb->resizeImage(250,$h,\Imagick::FILTER_LANCZOS,1, TRUE);
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
