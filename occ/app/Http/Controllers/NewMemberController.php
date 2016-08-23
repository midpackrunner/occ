<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use PayPal;

class NewMemberController extends Controller
{
    
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function pay_by_check()
	{
		return view('auth.member_confirmation_pay_by_check');
	}



}
