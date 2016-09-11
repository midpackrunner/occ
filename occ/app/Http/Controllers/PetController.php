<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Pet;
use App\Classes;
use App\Breed;
use App\MedicalRecord;
use App\Http\Requests\CreatePetRequest;
use Illuminate\Support\Facades\Auth;
use Carbon;

class PetController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('pet_owner', ['except' =>['download_med_rec']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breeds_array = Breed::all()->toArray();
        $breeds = array();
        foreach ($breeds_array as $br) {
            $breeds[$br['type']] = $br['type'];
        }
        $breeds['Other'] = 'Other';
        return view('pets.create', compact('breeds'));
    }

    /**
     * Store a newly created pet in the DB.
     *
     * @param  \Illuminate\Http\CreatePetRequest  $request
     * @return redirect back to user profile
     */
    public function store(CreatePetRequest $request)
    {
        $has_record = false;

        $pet = new Pet($request->all());
        Auth::user()->pets()->save($pet);
        if($request->hasFile('pet_record')) {
            PetController::handle_pet_record($pet, $request->file('pet_record'));
            $has_record = true;
        }
        $pet_name = $pet->name;

        return view('pets.confirmation', compact('has_record', 'pet_name'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        return view('pets.show')->with('pet', $pet);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pet $pet)
    {   
        return view('pets.edit')->with('pet', $pet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePetRequest $request, $pet)
    {
        $pet->update($request->all());
        Auth::user()->pets()->save($pet);
        if($request->hasFile('pet_record')) {
            PetController::handle_pet_record($pet, $request->file('pet_record'));
            $has_record = true;
        }
        session()->flash('flash_message', $pet->name . '\'s profile has been updated!');
        return redirect()->action('User\UserProfileController@show', 
                                   Auth::user()->user_profile->id);
    }

    public function download_med_rec($med_rec_id)
    {
        $med_rec = MedicalRecord::findOrFail($med_rec_id);
        return response()->download($med_rec->path_to_medical_record);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pet)
    {
        $user_profile = Auth::user()->user_profile;

        if (Auth::user()->id != $pet->user_id) {
            return 'forbidden';
        }
        $pet->delete();
        return 'success';
    }

    public function confirmation()
    {
        return view('pets.confirmation');
    }

    /**
     * Handles logging hours per class per pet
     *
     * @param      \Illuminate\Http\Request  $request  The request
     * @return return error message if hour log is > than 6, 
     *         otherwise return success message
     */
    public function log_hours(Request $request)
    {
        $class = Classes::findOrFail($request->class_id);
        if($request->attended_date > $class->end_date || $request->attended_date < $class->begin_date) {
            session()->flash('error_message', 'Error: ' . $request->attended_date . ' does not fall in between the beginning and ending of this class!  Time has not been logged, please try again.');
        } else {
            $pet = Pet::findOrFail($request->pet_id);
            $pet->attendance()->attach($class, ['attended_date'=> $request->attended_date]);
            foreach ($pet->classes as $class1) {   // loop thru each class the pet is in until match
                if ($class1->id == $class->id ){
                    if($class1->pivot->logged_hours == 5) {
                        $pet->classes()->detach($class);
                        $pet->classes()->attach($class, ['logged_hours' => 6,
                                                         'is_completed' => true]);   // update as complete
                    } else {
                        $pet->classes()->detach($class);
                        $pet->classes()->attach($class, ['logged_hours' => $class1->pivot->logged_hours + 1]);
                    }
                }
            }
            session()->flash('flash_message', $pet->name . '\'s hours for ' . 
                              $class->details->title . ' has been updated!');            
        }
        return redirect()->action('User\UserProfileController@show', 
                                   Auth::user()->user_profile->id);
    }

    // handles the saving of a pet's medical records.
    // All files created will be unique with timestamp.
    public static function handle_pet_record($pet, $pet_record)
    {
        $dest_path = config('app.med_records_location');
        $usr_prf = Auth::user()->user_profile;
        $usr_fname = $usr_prf->first_name;
        $usr_lname = $usr_prf->last_name;
        $pet_name = $pet->name;
        $file_ext = $pet_record->getClientOriginalExtension();
        $file_nm = $usr_fname . '_' . $usr_lname . '_' . $pet_name . 
                                '_' . Carbon::now(). '.' . $file_ext;
        $pet_record->move($dest_path, $file_nm);
        $med_rec = new MedicalRecord();
        $med_rec->path_to_medical_record = $dest_path . $file_nm;  
        $med_rec->pet_id = $pet->id;
        $pet->med_records()->save($med_rec);
        $med_rec->save();
        return $med_rec;
    }
}
