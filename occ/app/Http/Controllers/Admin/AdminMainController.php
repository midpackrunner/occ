<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use App\VolunteerHour;
use App\Membership;
use App\User;
use App\Classes;

class AdminMainController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('admin');
	}

	/**
	 * Returns the admin view.  Only users who have a role
	 * type of admin can access.
	 */
	public function index() {
		$notification = $this->get_notification_data();
		$max_session = Classes::maxSession();
		$max_year = 2025;
		return view('admin.index', compact('notification', 'max_session', 'max_year'));
	}

	private function get_notification_data() {
		$data;
		$data['unverified_vol_hours_cnt'] =
			 VolunteerHour::where('verified', '!=', 1)->count();
		$data['membership_expire_cnt'] =
			 Membership::where('end_date', '<' , Carbon::now())->count();

	    $total_unverified_med_recs = 0;
	    $users = User::all();
	    foreach ($users as $user) {
	    	$total_unverified_med_recs += 
	    						   $user->count_pets_with_expired_shots();
	    }
		$data['unverified_med_recs'] = $total_unverified_med_recs;
	    return $data;
	}

	public function ajax_class_enroll(Request $request)
	{

	}

}
