<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\VolunteerHour;
use App\Http\Requests;
use App\Http\Requests\VolunteerHourRequest;
use Auth;

class VolunteerHourController extends Controller
{


    public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin', ['except' =>['create', 'store']]);
    }
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vol_hrs = VolunteerHour::needsVerification()->get();
        return view('volunteer.index', compact('vol_hrs'));

    }

    /**
     * Show the form for claiming volunteer hours.  Only
     * the individual can claim time for him/herself.
     *
     */
    public function create()
    {
        return view('volunteer.create');
    }


    /**
     * Store claimed volunteer hours.
     */
    public function store(VolunteerHourRequest $request)
    {
        $user_profile = Auth::user()->user_profile;
        $vol_hr = new VolunteerHour($request->all());
        $user_profile->volunteer_hours()->save($vol_hr);
        VolunteerHour::sync_hours(Auth::user());

        return redirect()->action('User\UserProfileController@show', array('user_profile' => $user_profile))->with('confirm_vol_hrs', 'Your request to add ' . $vol_hr->hours . ' hours and '. $vol_hr->minutes.' minutes to your profile has been received.  We will review your request and contact you if there is any issues.  Thank you.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(VolunteerHour $vol_hr)
    {
        // not used.
        return view('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(VolunteerHour $vol_hr)
    {
        // not used.
        return view('/');
    }

    /**
     * Toggle verification on the claimed hours.  Currently,
     * volunteer hours that are marked as verified are hidden
     * from the user
     * @return forbidden if use is not Admin, otherwise return
     * success
     */
    public function update($id)
    {
        if (!Auth::user()->isAdmin()) {
            return 'forbidden';
        }

        $vol_hr = VolunteerHour::findOrFail($id);
        if ($vol_hr->verified) {
            $vol_hr->verified = 0;
            $vol_hr->verified_by = null;
        } else {
            $vol_hr->verified = 1; 
            $vol_hr->verified_by = Auth::user()->email;
        }
        $vol_hr->save();
        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($vol_hr)
    {
        if (!Auth::user()->isAdmin()) {
            return 'forbidden';
        }
        $vol_hr->delete();
        return 'success';        
    }
}
