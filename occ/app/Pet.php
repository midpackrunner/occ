<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;
use DB;

class Pet extends Model
{
    //
    protected $fillable = [
		'name', 'gender', 'is_spayed_neutered' ,
		'birth_date', 'breed', 'user_id',
    ];

    public function user() {
    	return $this->belongsTo('App\User');
    }

    // to get max $pet->med_records->max('shots_expire');
    public function med_records() {
        return $this->hasMany('App\MedicalRecord');
    }

    // relation pet's attendance per class
    public function attendance() {
        return $this->belongsToMany('App\Classes', 'class_attendances')
                    ->withPivot('attended_date')
                    ->withTimestamps();
    }

    // relation pet's classes
    public function classes()
    {
    	return $this->belongsToMany('App\Classes')
    				->withPivot('is_completed', 'logged_hours', 'verified_payment')
    				->withTimestamps();
    }

    // get upcoming classes the pet is registered for
    public function upcoming_classes()
    {
    	return $this->classes()->where('end_date', '>=', Carbon::now());
    }

    // get all classses the pet has completed
    public function completed_classes()
    {
        return $this->classes()->where('is_completed', true);
    }

    // check if pet has taken a class
    public function has_taken($class)
    {
        $has_taken = false;
        foreach($this->classes as $a_class) {
            if ($class->details->id == $a_class->details->id) {
                $has_taken = true;
            }
        }
        return $has_taken;
    }

    // Remove claimed attendance hours
    public static function detach_claimed_attendance($pet_id, $class_id, $date) 
    {
        DB::table('class_attendances')->where([
            ['pet_id', '=' , $pet_id],
            ['classes_id', '=', $class_id],
            ['attended_date', '=', $date]
        ])->delete();

        DB::table('classes_pet')->where([
            ['pet_id', '=' , $pet_id],
            ['classes_id', '=', $class_id]
        ])->decrement('logged_hours');

        DB::table('classes_pet')->where([
            ['pet_id', '=' , $pet_id],
            ['classes_id', '=', $class_id]
        ])->update(['is_completed'=> 0]);
    }
} 
