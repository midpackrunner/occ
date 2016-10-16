<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PetController;
use Illuminate\Http\Request;
use App\Http\Requests\CreateClassesDetailRequest;
use App\Lib\PaginationHelper;
use App\Http\Requests;
use App\MedicalRecord;
use App\Pet;
use App\User;
use Auth;
use Carbon;

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
    public function index($curr_page, $filter)
    {
        $users_t = User::all();
        if ($filter == 'expired') {
            $users = collect();
            foreach($users_t as $user) {
                if($user->has_pet_with_expired_shots()) {
                    $users->push($user);
                }
            }
        } else {
            $users = $users_t;
        }

        $page_helper = new PaginationHelper($users, 
                                config('app.max_viewable_med_recs'), $curr_page);
        $num_of_pages = $page_helper->get_num_of_pages();
        $users = $page_helper->get_sliced_collection();
        return view('admin.medical.index', compact('users', 'curr_page',
                                            'num_of_pages', 'filter')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\m_responsekeys(conn, identifier)
     */
    public function create($user_id)
    {
        $user = User::findOrFail($user_id);
        $pets = $user->pets;
        return view('admin.medical.create', compact('user', 'pets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pet = Pet::findOrFail($request->pet);
        $med_rec = new MedicalRecord();
        if ($request->has_records && $request->hasFile('pet_record')) {
            $pet_rec = $request->file('pet_record');
            $this->attach_med_record($pet, $med_rec, $pet_rec);
            $med_rec->record_is_hardcopy = 0;
        } else {
            $med_rec->pet_id = $request->pet;
            $med_rec->record_is_hardcopy = 1;
        }
        $med_rec->shots_verified = $request->shots_verified;
        $med_rec->shots_expire = $request->shots_expire;
        $med_rec->save();
        \Session::flash('flash_message', 'Successfully Updated Medical Records ');
        return redirect()->action('Admin\AdminMedicalRecordsController@index', ['curr_page' => 1, 'filter' => 'none']);
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
        //dd($id);
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
        $med_rec = MedicalRecord::findOrFail($id);
        $pet = $med_rec->pet;
        $med_rec->shots_verified = $request->shots_verified;
        $med_rec->shots_expire = $request->shots_expire;
        $med_rec->record_is_hardcopy = $request->record_is_hardcopy;

        if ($request->has_records && $request->hasFile('pet_record')) {
            $pet_rec = $request->file('pet_record');
            $this->attach_med_record($pet, $med_rec, $pet_rec);
            $med_rec->record_is_hardcopy = 0;
        }
        $med_rec->save();
        \Session::flash('flash_message', 'Successfully Updated Medical Records ');
        return  redirect('med_records/1/none');
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

    private function attach_med_record($pet, $med_rec, $pet_rec)
    {
        $dest_path = config('app.med_records_location');
        $usr_prf = $pet->user->user_profile;
        $usr_fname = $usr_prf->first_name;
        $usr_lname = $usr_prf->last_name;
        $pet_name = $pet->name;
        $file_ext = $pet_rec->getClientOriginalExtension();
        $file_nm = $usr_fname . '_' . $usr_lname . '_' . $pet_name . 
                                '_' . Carbon::now(). '.' . $file_ext;
        $pet_rec->move($dest_path, $file_nm);
        $med_rec->path_to_medical_record = $dest_path . $file_nm;  
        $med_rec->pet_id = $pet->id;
        $pet->med_records()->save($med_rec);
        $med_rec->save();
    }
    
}
