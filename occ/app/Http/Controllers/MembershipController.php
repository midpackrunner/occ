<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests;
use App\UserProfile;
use Auth;
use Carbon;
use File;
use Illuminate\Http\Request;
use PDF;

class MembershipController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    // TODO: get already created membership application pdf
    // so user can download.
    public function membership_application($id)
    {
        //dd($id);
        if (Auth::user()->role->type == 'admin' || 
            Auth::user()->user_profile->id == $id) {
            $usr_prf = UserProfile::findOrFail($id);
            $fname = $usr_prf->first_name;
            $lname = $usr_prf->last_name;
            $file_nm = $lname . "_" . $fname . ".pdf"; 

            $file_path = config('app.membership_docs'). $file_nm;
            //dd(config('app.membership_docs'));
            return response()->download($file_path);
        }
        return redirect('/home');

    }

    /**
     * Handles the creation of the membership application (pdf file).
     * This function takes the user's data from registration, generates
     * an html file which is parsed into a pdf file and stored.
     *
     * @param      <type>  $data   User supplied data during sign up
     */
    public static function make_mmbrshp_application(array $data)
    {

        $f_nm = ucfirst($data['first_name']);
    	$l_nm = ucfirst($data['last_name']);

    	$date = Carbon::now()->toDateString();
    	$file_nm = $l_nm . "_" . $f_nm . ".pdf"; 
    	$pdf = PDF::loadView('memberships.membership_application', $data);
    	$pdf->save(config('app.membership_docs'). $file_nm);
    }
}
