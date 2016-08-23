<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\PhoneNumber;
use Auth;

class PhoneNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $phone_number = new PhoneNumber();
        return view('phone_numbers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $phone_number = new PhoneNumber();
        $phone_number->number = $request['phone_number'];
        $phone_number->type = $request['phone_type'];
        $phone_number->save();
        $user_profile = Auth::user()->user_profile;
        $user_profile->phone_numbers()->attach($phone_number);
        return redirect()->action('User\UserProfileController@edit', $user_profile);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $phone_number = PhoneNumber::findOrFail($id);

        return view('phone_numbers.edit')
                    ->with('phone_number', $phone_number);
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
        $request = $request->all();
        $phone_number = PhoneNumber::findOrFail($id);
        $phone_number->number = $request['phone_number'];
        $phone_number->type = $request['phone_type'];
        $phone_number->save();
        $user_profile = Auth::user()->user_profile;
        return redirect()->action('User\UserProfileController@edit', $user_profile);
    }

    /**
     * Remove the specified resource from storage.
     * todo!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $user_profile = Auth::user()->user_profile;

        // if (Auth::user()->id != $pet->user_id) {
        //     return 'forbidden';
        // }
        // $pet->delete();
        // return 'success';
    }
}
