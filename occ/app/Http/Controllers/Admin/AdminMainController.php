<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


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
		return view('admin.index');
	}

}
