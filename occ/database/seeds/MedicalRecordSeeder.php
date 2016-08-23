<?php

use Illuminate\Database\Seeder;

class MedicalRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$usr = App\User::where('email', '=', 'cmbonham@hotmail.com')->first();
    	$usr_prf = $usr->user_profile;
        $usr_fname = $usr_prf->first_name;
        $usr_lname = $usr_prf->last_name;
        $pet = App\Pet::where('name', '=', 'Dude')->first();
        $pet_name = $pet->name;
        $file_nm = $usr_fname . '_' . $usr_lname . '_' . $pet_name . '_' . Carbon::now();
        
        App\MedicalRecord::create([
			'path_to_medical_record' => config('app.med_records_location'). $file_nm,
			'pet_id' => $pet->id,
		]);

    }
}
