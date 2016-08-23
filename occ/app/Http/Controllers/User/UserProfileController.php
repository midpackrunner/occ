<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\UserProfile;
use Auth;
use App\Shared_Data\States;

class UserProfileController extends Controller
{



    public function index()
    {
        return '<h2>Error</h2>';
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return "create";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        return "store";
    }

    /**
     * Display the User's profile.  Only the authenticated user
     * can view their own profile.  Profile includes contact info,
     * current membership details, registered Pets, and registered
     * courses.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfile $user_profile)
    {
        if (!UserProfileController::verify_user($user_profile->user->id)) {
            return redirect()->action('HomeController@index');
        }
        return view('profiles.show', compact('user_profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProfile $user_profile)
    {
        if (!UserProfileController::verify_user($user_profile->user->id)) {
            return redirect()->action('HomeController@index');
        }

        $states_obj = new States();
        $states = $states_obj->get_states();
        return view('profiles.edit', compact('user_profile', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_profile)
    {
        if (!UserProfileController::verify_user($user_profile->user->id)) {
            return redirect()->action('HomeController@index');
        }
        $user_profile->street_address = $request->street_address;
        $user_profile->city = $request->city;
        $user_profile->state  = $request->state;
        $user_profile->zip = $request->zip;
        $user_profile->save();
        $states_obj = new States();
        $states = $states_obj->get_states();
        session()->flash('flash_message', 'Mailing Address updated successfully!');
        return view('profiles.edit', compact('user_profile', 'states'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return "destroy";
    }

    /**
     * Verifies that the currently Authenticated User is the
     * User trying to access a resource.
     *
     * @return boolean true if the User requesting a user profile
     * resource is the User that the profile belongs to, otherwise
     * returns false.  
     */
    private function verify_user($user_id) {
        if (Auth::id() != $user_id) {
            return false;
        }
        return true;        
    }
}
