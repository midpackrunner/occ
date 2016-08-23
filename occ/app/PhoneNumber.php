<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'number',
    ];
    

    public function user_profile() {
    	// need withTimestamps to stamp the pivot table
    	return $this->belongsToMany('App\UserProfile',
                                    'phone_number_user_profile')->withTimestamps();
    }
}
