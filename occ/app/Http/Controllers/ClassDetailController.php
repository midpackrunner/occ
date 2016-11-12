<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateClassesDetailRequest;
use App\Http\Requests;
use App\ClassesDetail;
use Auth;

class ClassDetailController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' =>['show']]);
        $this->middleware('admin', ['except' =>['show']]);
    }  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes_details = ClassesDetail::all();

        return view('class_details.index', compact('classes_details')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\m_responsekeys(conn, identifier)
     */
    public function create()
    {
        $prereq_arry = ClassesDetail::all()->toArray();
        $pre_reqs = array();
        foreach ($prereq_arry as $prerq) {
            $pre_reqs[$prerq['id']] = $prerq['title'];
        }
        return view('class_details.create', compact('pre_reqs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateClassesDetailRequest $request)
    {
        $class_details = new ClassesDetail($request->all());
        // pre-req logic
        $pre_reqs = $request->pre_reqs;
        if ($pre_reqs == null) {
            $class_details->pre_reqs()->sync([]);
        } else {
            $class_details->pre_reqs()->sync($pre_reqs);
        }
        $class_details->save();
        \Session::flash('message', 'Successfully created class ' .
                                    $class_details->title);
        return redirect('class_details');
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
        return view('class_details.show', compact('class_detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classes_details = ClassesDetail::findOrFail($id);
        $prereq_arry = ClassesDetail::all()->toArray();
        $pre_reqs = array();
        foreach ($prereq_arry as $prerq) {
            $pre_reqs[$prerq['id']] = $prerq['title'];
        }
        return view('class_details.edit', compact('classes_details', 'pre_reqs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateClassesDetailRequest $request, $id)
    {
        $classes_details = ClassesDetail::findOrFail($id);
        $classes_details->title = $request->title;
        $classes_details->description = $request->description;
        $classes_details->cost = $request->cost;
        $classes_details->is_active = $request->is_active;
        $classes_details->minimum_age_requirement = $request->minimum_age_requirement;
        $classes_details->maximum_age_requirement = $request->maximum_age_requirement;

        // pre-req logic
        $pre_reqs = $request->pre_reqs;
        if ($pre_reqs == null) {
            $classes_details->pre_reqs()->sync([]);
        } else {
            $classes_details->pre_reqs()->sync($pre_reqs);
        }

        $classes_details->save();
        \Session::flash('message', 'Successfully updated class ' .
                                    $classes_details->title);
        return redirect('class_details');
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
