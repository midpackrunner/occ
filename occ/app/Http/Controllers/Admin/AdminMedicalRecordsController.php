<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateClassesDetailRequest;
use App\Lib\PaginationHelper;
use App\Http\Requests;
use App\MedicalRecord;
use App\Pet;
use App\User;
use Auth;

class AdminMedicalRecordsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin');
    }  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($curr_page)
    {
        $users = User::all();
        $page_helper = new PaginationHelper($users, 
                                config('app.max_viewable_med_recs'), $curr_page);
        $num_of_pages = $page_helper->get_num_of_pages();
        $users = $page_helper->get_sliced_collection();

        return view('admin.medical.index', compact('users', 'curr_page',
                                            'num_of_pages')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\m_responsekeys(conn, identifier)
     */
    public function create()
    {
        return view('admin.medical.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        Session::flash();
        return redirect('admin.medical');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $class_detail = ClassesDetail::findOrFail($id);
        return view('admin.medical.show', compact('class_detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medical_record = MedicalRecord::findOrFail($id);
       // dd($class_detail);
        return view('admin.medical.edit', compact('medical_record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd($request);
        \Session::flash('message', 'Successfully updated class ');
        return redirect('admin.medical');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}
