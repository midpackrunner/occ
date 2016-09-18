<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    protected $fillable = [
		'date_of_event', 'title', 'description',
    ];

    public function scopeUpcoming($query)
    {
    	return $query->where('date_of_event', '>=', Carbon::now());
    }

}
