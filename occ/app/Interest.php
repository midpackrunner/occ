<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $fillable = [
    	'name'
    ];

    public function user_profiles()
    {
    	return $this->belongsToMany('App\UserProfile', 'interest_user_profile', 'interest_id', 'user_profile_id')->withTimestamps();
    }
}
