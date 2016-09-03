<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests;
use App\UserProfile;
use App\Membership;
use App\MembershipType;
use Auth;
use Carbon;
use File;
use Illuminate\Http\Request;
use PDF;
use App\Http\Requests\MembershipRequest;

class MembershipController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
   
    /**
     * Returns a pdf of the member's application.
     *
     */
    public function membership_application($id)
    {
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

    public function edit(Membership $membership)
    {
        $membership_types = Array();
        $mem_type_list = MembershipType::all();
        foreach ($mem_type_list as $memb_typ) {
            $membership_types[$memb_typ->id] = $memb_typ->name .':  $' . $memb_typ->cost;
        }

        return view('memberships.edit', compact('membership', 'membership_types'));
    }

    public function update(MembershipRequest $request)
    {
        $payment_method = $request->payment_method;

        if ($payment_method == 'paypal') {

            return redirect('renew_membership_paypal_payout/' . $request->membership_type_id);
        } else {
            $membership = Auth::user()->user_profile->membership;
            $membership->membership_type_id = $request->membership_type_id;
            $membership->payment_method = "check";
            $membership->save();

            return view('memberships.member_renewal_confirmation_pay_by_check')->with('membership', $membership);
        }

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
