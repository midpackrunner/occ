<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use File;
use App;
use PDF;
use Carbon;

class MembershipController extends Controller
{
    //
    // TODO: get already created membership application pdf
    // so user can download.
    public function membership_application()
    {

    	$pdf = PDF::loadView('memberships.membership_application');
    	$pdf->save(config('membership_docs').'test_mem_app.pdf');
		return $pdf->stream('membership_application.pdf');

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

        $f_nm = $data['first_name'];
    	$l_nm = $data['last_name'];

    	$date = Carbon::now()->toDateString();
    	$file_nm = $l_nm . "_" . $f_nm . "_" . $date . ".pdf"; 
    	$pdf = PDF::loadView('memberships.membership_application', $data);
    	$pdf->save('/var/www/html/membership_docs/'. $file_nm);
    }
}
