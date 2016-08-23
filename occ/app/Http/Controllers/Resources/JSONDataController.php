<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

class JSONDataController extends Controller
{

    protected $path_to_sources = '../occ/app/Shared_Data/';
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


    public function states()
    {
        $states_json = file_get_contents($this->path_to_sources .'states.json');
        return $states_json;
        // return getcwd();
    }
}
