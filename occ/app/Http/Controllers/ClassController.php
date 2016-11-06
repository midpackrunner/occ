<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\ClassesDetail;
use App\Classes;
use App\Pet;
use App\Instructor;
use App\TempPaypalClassSignup;
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
        $class_cost = ClassController::calculate_class_cost($class);
        $pet_arry = [];
        if ($pets != null) {
            foreach ($pets as $pet) {
                $pet_arry[$pet->id] = $pet->name;
            }
        }
        //dd($class);
        return view('classes.class_sign_up', compact('user_profile', 'pet_arry', 'class', 'class_cost'));
    }

    /**
     * Handles the registering of a Pet to a class.  If volunteer
     * hours are used as MOP, then reduces the user_profile's 
     * total vol hours.  If PayPal is used, then enter a temp record
     * into TempPaypalClassSignup.  After payment is confirmed, add
     * pet to class.  If paying by check, we act on "good faith" of
     * receiving the payment.
     *
     */
    public function post_class_sign_up(ClassSignUpRequest $request)
    {

        $pay_method = $request->payment_method;
        $class = Classes::findOrFail($request->class_id);

        if ($pay_method == "paypal") {
            $temp_class_pet = new TempPaypalClassSignup();
            $token = substr(md5(rand()), 0, 32);
            $temp_class_pet->token = $token;
            $temp_class_pet->pet_id = $request->pet_id;
            $temp_class_pet->class_id = $request->class_id;
            $temp_class_pet->pay_amount = ClassController::calculate_class_cost($class);
            $temp_class_pet->save();
            return redirect('class_pay_with_pay_pal/' . $token);
        } else {
            if ($pay_method == "volhours") {
                Auth::user()->user_profile->total_volunteer_hrs -= 6;
                Auth::user()->user_profile->save();
            }  // else we are paying by check
                $pet = Pet::findOrFail($request->pet_id);
                ClassController::handle_class_sign_up($request->class_id, 
                                                      $request->pet_id, $pay_method);
                return view('classes.sign_up_confirmation', compact('pet', 'class', 'pay_method'));
        }
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

    /**
     * Handles adding the pet to the class (classes_pet table).
     * If paypal payment, then remove from temp table IF token
     * is passed.
     *
     * @param      <type>  $class_id  The class identifier
     * @param      <type>  $pet_id    The pet identifier
     * @param      <type>  $token     The token
     */
    public static function handle_class_sign_up($class_id, $pet_id, $pay_meth, $token=null)
    {
        $pet = Pet::findOrFail($pet_id);
        $class = Classes::findOrFail($class_id);
        $class->pets()->attach($pet, array('pay_method' => $pay_meth));
        $class->vacant = $class->vacant - 1;
        $class->on_hold = $class->on_hold + 1;
        $class->save();
        if ($token != null) {
            $pet_piv = $class->pets()->where('pet_id', $pet_id)->first();
            $pet_piv->pivot->verified_payment = 1;
            $pet_piv->pivot->save();
            $tmp = TempPaypalClassSignup::where('token', $token)->first();
            $tmp->delete();
        }
    }

    /**
     * Calculates the class cost. Possible discounts on class
     * cost include: (a) member has taken 5 or more classes,
     * (b) member has taken a class in the previous session
     * (c) member's discount
     *
     * @param      <type>  $class  The class
     *
     * @pre Assumption: 7 sessions in a year
     */
    public static function calculate_class_cost($class)
    {
        $usr_prf = Auth::user()->user_profile;
        $membership_type = $usr_prf->membership->membership_type->name;
        if ($membership_type != 'student') {
            $member_discount = $class->details->discounts->regular_member_discount;
        } else {
            $member_discount = 0;
        }
        
        
        if (Auth::user()->hasFiveOrMoreClasses()) {
            return $class->details->cost - $class->details->discounts->five_or_more_discount;
        }
        if (Auth::user()->hasSuccessiveClass(substr($class->begin_date, 0, 4),
                                              $class->session)) {
            return $class->details->cost - $member_discount - 
                   $class->details->discounts->successive_class_discount;
        }

        return $class->details->cost - $member_discount;
    }

}
