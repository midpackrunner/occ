<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Carousel;
use App\Announcement;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carousels = Carousel::all();
        $curr_announcements = Announcement::ispublished()
                              ->isnotremoved()->get();

        return view('home.welcome')
                            ->with('carousels', $carousels)
                            ->with('announcements', $curr_announcements);
    }
}
