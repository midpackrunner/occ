<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialSkill extends Model
{
    //
    protected $fillable = [
    	'skill_description', 'user_profile_id'
    ];

    public function user_profile()
    {
    	return $this->belongsTo('App\User');
    }
}
