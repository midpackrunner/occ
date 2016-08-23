<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\ClassesDetail;
use App\Classes;
use App\Pet;
use App\Instructor;
use App\Lib\ScheduleUploader;
use App\Http\Requests\CreateClassesRequest;
use App\Http\Requests\ClassSignUpRequest;
use Auth;
use App\MembershipType;

class ClassController extends Controller
{
    
    //
    public function __construct()
    {

    }

    /**
     * Public View
     * Returns the class details model to the index view.
     * The $number field is used to increment a unique html class.
     */
    public function class_info()
    {
        $regular_mmbrshp_discount = MembershipType::where('name', '=', 'household')->first()->discount_on_classes;
        $student_mmbrshp_discount = MembershipType::where('name', '=', 'student')->first()->discount_on_classes;
    	$class_details = ClassesDetail::all();
    	$number = 1; 
    	$active_view = 'classes';
    	return view('classes.class_info', compact('class_details', 'number', 'regular_mmbrshp_discount', 'student_mmbrshp_discount'));
    }

    /**
     * Returns a class schedule view with only the upcoming
     * classes for possible registration
     */
    public function schedule($curr_page)
    {
        $max_viewable = 10;
        $classes = Classes::upComing()->isOpen()->hasRoom()->get();

        $num_of_pages = count($classes) / $max_viewable;
        $num_of_pages = ceil($num_of_pages);
        $classes = $classes->slice($max_viewable * $curr_page - $max_viewable, $max_viewable);
    	return view('classes.class_schedule', compact('classes', 'curr_page', 'num_of_pages'));
    }

    /**
     * Returns pre-class preperation details
     */
    public function pre_class_prep()
    {
    	return view('classes.pre_class_prep');
    }

    /**
     * Displays form to signup for a class
     *
     * @param      <int>  $class_id  The class identifier
     *
     * @return     <view>  Sign Up Form with Class information
     */
    public function class_sign_up($class_id)
    {

        $class = Classes::findOrFail($class_id);
        $user_profile = Auth::user()->user_profile;
        $pets = Auth::user()->pets_not_taken_class($class);

        $pet_arry = [];
        if ($pets != null) {
            foreach ($pets as $pet) {
                $pet_arry[$pet->id] = $pet->name;
            }
        }
        //dd($class);
        return view('classes.class_sign_up', compact('user_profile', 'pet_arry', 'class'));
    }

    /**
     * Handles the registering of a Pet to a class.  If volunteer
     * hours are used as MOP, then reduces the user_profile's 
     * total vol hours.
     *
     */
    public function post_class_sign_up(ClassSignUpRequest $request)
    {
        $pet = Pet::findOrFail($request->pet_id);
        $class = Classes::findOrFail($request->class_id);
        $class->pets()->attach($pet);
        $class->vacant = $class->vacant - 1;
        $class->on_hold = $class->on_hold + 1;
        $class->save();

        $pay_method = $request->payment_method;

        if ($pay_method == "volhours") {
            Auth::user()->user_profile->total_volunteer_hrs -= 6;
            Auth::user()->user_profile->save();
        }
        
        return view('classes.sign_up_confirmation', compact('pet', 'class', 'pay_method'));
    }

    /**
     * Display the Class.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $class = Classes::findOrFail($id);
        return view('classes.show')->with('class', $class);
    }

}
