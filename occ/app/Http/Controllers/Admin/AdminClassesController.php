<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateClassesDetailRequest;
use App\Http\Requests;
use App\ClassesDetail;
use Auth;
use App\Classes;
use App\Instructor;
use App\Lib\PaginationHelper;
use App\Lib\ScheduleUploader;

class AdminClassesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Not used.
     * Display a listing of Classes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "Error";
    }

    /**
     * Returns a listing of all classes that are upcoming.
     *
     * @param  $curr_page The current page the user is on
     *
     * @return pagination of upcoming classes
     */
    public function classes_full_list($curr_page)
    {
        $classes = Classes::upComing()->get();
        $page_helper = new PaginationHelper($classes, 
                                config('app.max_viewable_classes'), $curr_page);
        $num_of_pages = $page_helper->get_num_of_pages();
        $classes = $page_helper->get_sliced_collection();
        return view('classes.index', compact('classes', 'curr_page', 'num_of_pages'));
    }

    public function show($id)
    {
    	$class = Classes::findOrFail($id);
    	return view('classes.show', compact('class'));
    }

    /**
     * Store a newly created class in the DB.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return redirect back to user profile
     */
    public function store(Request $request)
    {	
        $class = new Classes($request->all());
        $class->vacant = $request->capacity;
        $class->save();
        // clear all instructors
        $class->instructors()->detach();
        if(count($request->instructors) > 0) {
            foreach ($request->instructors as $inst) {
                $class->instructors()->attach($inst);
            }
        }
        $class->save();
        session()->flash('flash_message', 
        				  $class->details->title . " has been added");
        return redirect()->action('Admin\AdminClassesController@classes_full_list', ['curr_page' => 1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instructor_array = Instructor::all()->toArray();
        $instructors = array();

        foreach ($instructor_array as $inst) {
            $instructors[$inst['id']] = $inst['first_name']. " ".
                                        $inst['last_name'];
        }

        $class_details_arry = ClassesDetail::isActive()->get()->toArray();
        $class_details = array();
		foreach ($class_details_arry as $cl_dtl) {
            $class_details[$cl_dtl['id']] = $cl_dtl['title'];
        }

        return view('classes.create', compact('instructors', 'class_details'));
    }

    /**
     * Show the form for editing a Class.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $classes)
    {
        $instructor_array = Instructor::all()->toArray();
        $instructors = array();
        foreach ($instructor_array as $inst) {
            $instructors[$inst['id']] = $inst['first_name']. " ".
                                        $inst['last_name'];
        }

        $current_instructors = $classes->instructors->toArray();   
        return view('classes.edit', compact('classes', 'instructors','current_instructors'));
    }

    /**
     * Update the Class in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $class = Classes::findOrFail($id);
        // set new values
        $class->session = $request->session;
        $class->entrance = $request->entrance;
        $class->day_of_week = $request->day_of_week;
        $class->time = $request->time;
        $class->begin_date = $request->begin_date;
        $class->end_date = $request->end_date;
        $cap = $request->capacity;
        if ($cap != $class->vacant + $class->on_hold) {  // capacity has changed
            $class->capacity = $cap;
            $diff = $cap - ($class->vacant + $class->on_hold);
            $class->vacant += $diff;                     // adjust vacant
        }
        $class->is_open = $request->is_open;

        // clear all instructors
        $class->instructors()->detach();
        if(count($request->instructors) > 0) {
            foreach ($request->instructors as $inst) {
                $class->instructors()->attach($inst);
            }
        }
        $class->save();
		session()->flash('flash_message', 
        				  $class->details->title . " has been updated");
        return redirect()->action('Admin\AdminClassesController@classes_full_list', ['curr_page' => 1]);
    }

    /**
     * Remove the Class from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($class)
    {
        $class->delete();
        return view('classes.classes_full_list', ['curr_page' => 1]);
    }


    /**
     * Display view to upload a CSV file containing the class
     * schedule.
     *
     * @returned View
     */
    public function upload_schedule()
    {
        return view('classes.upload_schedule');
    }

    // Handle the uploading csv file of schedule
    public function post_schedule(Request $request)
    {
        $this->validate($request, [
            'class_schedule_file' => 'required|mimes:csv,txt'
        ]);
        $destinationPath = config('app.schedule_folder');
        $fileName = 'class_schedule';
        if($request->hasFile('class_schedule_file')) {
            $request->file('class_schedule_file')
                    ->move($destinationPath, $fileName);
        }

        $schedule_loader = new ScheduleUploader($destinationPath . $fileName);

        $schedule_loader->update();
        $num_of_records = $schedule_loader->get_num_of_new_records();
        $duplicate_results = $schedule_loader->get_duplicate_results();
        $num_of_naming_errors = $schedule_loader->get_num_of_naming_errors();

        return view('classes.upload_schedule', compact('num_of_records', 'duplicate_results', 
                                                       'num_of_naming_errors'));
    }
}  