<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon;
use DB;

class Pet extends Model
{
    //
    
    use SoftDeletes;
    protected $fillable = [
		'name', 'gender', 'is_spayed_neutered' ,
		'birth_date', 'breed', 'user_id', 'overrride_class_id'
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
    				->withPivot('is_completed', 'logged_hours', 'verified_payment', 'pay_method')
    				->withTimestamps();
    }

    // get upcoming classes the pet is registered for
    // allow three weeks after class ends to log hours
    public function upcoming_classes()
    {
    	return $this->classes()->where('end_date', '>=', Carbon::now()->subWeeks(3));
    }

    // get all classses the pet has completed
    public function completed_classes()
    {
        return $this->classes()->where('is_completed', true);
    }

    public function has_pre_req($class)
    {
        $class_detail = $class->details;
        if (sizeof($class_detail->pre_reqs) == 0) {
            return true;
        }
        $has_pre_req = false;
        foreach ($this->completed_classes as $comp_class) {
            foreach ($class_detail->pre_reqs as $pre_req) {
                if($comp_class->details->id == $pre_req->id) {
                    $has_pre_req = true;
                }
            }
        }
        return $has_pre_req;
    }

    public function is_taking_class($class) {
        foreach ($this->classes as $cl) {
            if ($cl->id == $class->id) {
                return true;
            }
        }
        return false;
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
} 
