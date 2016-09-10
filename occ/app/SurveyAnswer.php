<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyAnswer extends Model
{
    protected $fillable = [
		'response', 'details',
    ];

    public function user_prf()
    {
    	return $this->belongsTo('App\UserProfile');
    }
}
