<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipSponsor extends Model
{
    protected $fillable = [
    	'sponsor_name',
    	'user_profile_id'
    ];

    public function user_profile() {
    	return $this->belongsTo('App\UserProfile');
    }

}
