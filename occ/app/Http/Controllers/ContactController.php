<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the Contact Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.contact');
    }
}
