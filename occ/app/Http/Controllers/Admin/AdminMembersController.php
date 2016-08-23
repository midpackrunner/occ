<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\UserProfile;
use Auth;
use Carbon\Carbon;
use App\Lib\MemberFileManager;
use App\Lib\PaginationHelper;

class AdminMembersController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin');
    }  

    /**
     *  Display a listing of all users with pagniation
     *  todo: use filters
     */
    public function members($curr_page, $filter)
    {
        switch($filter) {
            case 'none':
                $user_profiles = UserProfile::orderBy('last_name')
                                 ->orderBy('last_name')->get();
            break;
            case 'student_membership';
                $user_profiles = UserProfile::isStudentMember()
                                 ->orderBy('last_name')->get();
            break;
            case 'regular_membership';
                $user_profiles = UserProfile::isRegularMember()
                                 ->orderBy('last_name')->get();
            break;
            case 'expired_membership';
                $user_profiles = UserProfile::hasExpiredMembership()
                                 ->orderBy('last_name')->get();
            break;       
            default:
                $user_profiles = UserProfile::orderBy('last_name')->get();
        }
        $page_helper = new PaginationHelper($user_profiles, 
                                config('app.max_viewable_members'), $curr_page);
        $num_of_pages = $page_helper->get_num_of_pages();
        $user_profiles = $page_helper->get_sliced_collection();
        $now = Carbon::now();
        return view('profiles.index', 
        			compact('user_profiles', 'curr_page', 'num_of_pages', 'filter', 'now'));
    }

    public function update_membership_status($usr_prf_id)
    {
    	$usr_prf = UserProfile::findOrFail($usr_prf_id);
    	$membership = $usr_prf->membership;

    	$old_yr = substr($membership->end_date, 0, 4);
        $membership->end_date = Carbon::createFromDate($old_yr + 1, 1, 1);
        $membership->save();

    	return back();
    }

    public function download_members($filter)
    {
        $file_mngr = new MemberFileManager($filter);

        $file_mngr->write_to_file();
        return response()->download($file_mngr->get_file_path());
    }	

}
