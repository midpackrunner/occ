<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $fillable = [
    	'first_name', 'last_name'
    ];

    public function classes()
    {
    	return $this->belongsToMany('App\Classes');
    }

    public function bio()
    {
    	return $this->belongsTo('App\Biography', 'biography_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
