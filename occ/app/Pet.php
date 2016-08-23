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

    public function med_records() {
        return $this->hasMany('App\MedicalRecord');
    }

    public function attendance() {
        return $this->belongsToMany('App\Classes', 'class_attendances')
                    ->withPivot('attended_date')
                    ->withTimestamps();
    }
    public function classes()
    {
    	return $this->belongsToMany('App\Classes')
    				->withPivot('is_completed', 'logged_hours', 'verified_payment')
    				->withTimestamps();
    }

    public function upcoming_classes()
    {
    	return $this->classes()->where('end_date', '>=', Carbon::now());
    }

    public function completed_classes()
    {
        return $this->classes()->where('is_completed', true);
    }

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
