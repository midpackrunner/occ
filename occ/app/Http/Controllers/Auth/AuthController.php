<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use App\UserProfile;
use App\PhoneNumber;
use Carbon\Carbon;
use App\SpecialSkill;
use App\Membership;
use App\MembershipType;
use App\MembershipSponsor;
use App\SurveyAnswer;
use App\Http\Controllers\MembershipController;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'street_address' => 'required|min:4',
            'city' => 'required|min:2',
            'state' => 'required|alpha_num|min:2',
            'zip' => 'required|integer',
            'phone_number' => 'required',
            'phone_type' => 'required',
            'membership_type' => 'required',
            'payment_method' => 'required',
            'survey_details' => 'required_if:rev-resource,Other',

            //'password' => ['required','min:6','confirmed',
              //             'regex:^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$^'],
        ], [
            'membership_type.required' => "Please select a membership type"
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     * Initialize a new user_profile, including; User(logon credentials),
     * PhoneNumber, and Membership(the membership type and the payment method), 
     * interests, and special skills.
     *
     * @param  array  $data the post data returned from the register form
     * @return User the new user that is created
     */
    protected function create(array $data)
    {
        // Create PDF membership application
        MembershipController::make_mmbrshp_application($data);
        // handle roll, password
        $role = Role::firstOrCreate(['type' => 'general_user']);
        $user = User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'roles_id' => $role->id,
            'has_logged_in_once' => 1
        ]);

        // create profile
        $user_profile = UserProfile::create([
            'first_name' => trim(ucfirst($data['first_name'])),
            'last_name' => trim(ucfirst($data['last_name'])),
            'street_address' => $data['street_address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zip' => $data['zip'],
            'is_occ_member' => 1,
            'willing_to_work' => $data['willing_to_work'],
            'user_id' => $user->id
        ]);

        // attach phone number to profile
        $phone_number = PhoneNumber::create([
            'number' => $data['phone_number'],
            'type' => $data['phone_type'], 
        ]);

        $user->user_profile()->save($user_profile);
        $user_profile->phone_numbers()->attach($phone_number->id);

        //attach interests
        if(!array_key_exists('interests', $data)) {
            $interests = null;
            array_push($data, $interests);
        } else {
            $interests = $data['interests'];
            foreach ($interests as $interest) {
                $user_profile->interests()->attach($interest);
            }
        }

        // attach special skills
        if(!empty($data['special_skills'])) {
            $special_skill = SpecialSkill::create([
                'skill_description' => $data['special_skills'],
                'user_profile_id' => $user_profile->id,
            ]);
        }

        // attach membership: If the membership is created in Oct. or later
        // then membership is good for the following year.
        $month_flag = 10;
        $date_now = Carbon::now();
        if ($date_now->month >= $month_flag) {
            $mem_end_date = Carbon::createFromDate($date_now->addYears(2)->year, 1, 1, 'UTC');
            $date_now->addYears(-2);
        } else {
            $mem_end_date = Carbon::createFromDate($date_now->addYears(1)->year, 1, 1, 'UTC');
            $date_now->addYears(-1);
        }
        $membership = Membership::create([
            'start_date' => $date_now,
            'end_date' => $mem_end_date,
            'membership_type_id' => $data['membership_type'],
            'payment_method' => $data['payment_method'], 
        ]);
        $user_profile->membership_id = $membership->id;
        $user_profile->save();

        // Sponsor Functionality removed as requested
        // if the membership is of any type other than 'student' then
        // 2 sponsors are required
        // $mem_type_id = $data['membership_type'];
        // if ($mem_type_id != 4) {     // 4 = student type membership
        //     MembershipSponsor::create([
        //         'sponsor_name' => $data['sponsor1'],
        //         'user_profile_id' => $user_profile->id
        //     ]);
        //     MembershipSponsor::create([
        //         'sponsor_name' => $data['sponsor2'],
        //         'user_profile_id' => $user_profile->id
        //     ]);

        // }
        // how did they hear about us
        $mem_type_id = $data['membership_type'];
        $rev_resource = $data['rev_resource'];
        $survey_details = $data['survey_details'];
        $survey_answer = SurveyAnswer::create([
            'response' => $rev_resource,
            'details' => $survey_details,
            'user_profile_id' => $user_profile->id,
        ]);

        $survey_answer->save();

        // branch: if user is paying by check redirect to confirmation
        // page.  Otherwise user is paying by paypal
        if ($data['payment_method'] == 'check') {
            $this->redirectTo = '/member_confirmation_pay_by_check';
        } else {
            $cost = MembershipType::findOrFail($mem_type_id)->first()->cost;
            $mem_name  = MembershipType::findOrFail($mem_type_id)->first()->name;
            $this->redirectTo = '/create_membership_paypal_payout';
            //$this->redirectTo = '/create_paypal_payout/' . $cost . 
            //                    '/' . $user->email . '//' . $mem_name;
        }

        return $user;
    }
}
