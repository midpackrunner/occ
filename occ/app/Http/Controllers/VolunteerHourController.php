<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\VolunteerHour;
use App\Http\Requests;
use App\Http\Requests\VolunteerHourRequest;
use Auth;

class VolunteerHourController extends Controller
{
    
	//todo need to speak with Susan about this
    public function create()
    {
    	return view('volunteer.create');
    }

    public function store(VolunteerHourRequest $request)
    {
    	$user_profile = Auth::user()->user_profile;
        $vol_hr = new VolunteerHour($request->all());
    	$user_profile->volunteer_hours()->save($vol_hr);
    	VolunteerHour::sync_hours(Auth::user());



    	return redirect()->action('User\UserProfileController@show', array('user_profile' => $user_profile))->with('confirm_vol_hrs', 'Your request to add ' . $vol_hr->hours . ' hours and '. $vol_hr->minutes.' minutes to your profile has been received.  We will review your request and contact you if there is any issues.  Thank you.'); 
    }
}
