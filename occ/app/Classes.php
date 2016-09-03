<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Classes extends Model
{
	use SoftDeletes;

    protected $table = 'classes';
    protected $fillable = [
		'day_of_week', 'begin_date', 'end_date' , 'session',
		'entrance', 'capacity', 'vacant', 'on_hold',
		'time', 'class_details_id', 'is_open'
    ];

    // use $classes->trashed() boolean to see if an item is soft deleted
    protected $dates = ['deleted_at'];

    // App\Classes::ofSession('4')->get()
    public function scopeOfSession($query, $session)
    {
    	return $query->where('session', $session);
    }

    // return only those classes whose end date is not today
    public function scopeUpComing($query)
    {
    	return $query->where('end_date', '>=', Carbon::today());
    }

    // return only those classes that are open to the public
    public function scopeIsOpen($query)
    {
        return $query->where('is_open', '=', 'yes');
    }

    // return on those classes that have vacany still
    public function scopeHasRoom($query)
    {
        return $query->where('vacant', '>', 0);
    }

    // return details of a class
    public function details()
    {
    	return $this->belongsTo('App\ClassesDetail', 'class_details_id');
    }

    public function scopeHasInstructor($query,$inst_id)
    {
        $pivot = $this->instructors()->getTable();
        $query->whereHas('instructors', function ($q) use ($inst_id, $pivot) {
            $q->where("{$pivot}.instructor_id", $inst_id);
        });
    }

    // return all instructors belonging to a class
    public function instructors()
    {
    	return $this->belongsToMany('App\Instructor')->withTimestamps();
    }

    // returns all pets belonging to a class
    public function pets()
    {
        return $this->belongsToMany('App\Pet')
                    ->withPivot('is_completed', 'logged_hours', 'verified_payment')
                    ->withTimestamps();
    }

    public function attendees()
    {
        return $this->belongsToMany('App\Pet', 'class_attendances')
            ->withPivot('attended_date')
            ->withTimestamps();
    }
    public function get_day()
    {
        return $this->day_of_week;
    }

    public static function maxSession()
    {
        return DB::table('classes')->max('session');
    }  
    
}


/**
 * Using Soft Deletes
 * 
 *   $flights = App\Flight::withTrashed()
                ->where('account_id', 1)
                ->get();
 *
 *   $flights = App\Flight::onlyTrashed()
                ->where('airline_id', 1)
                ->get();
 * 
 *   restore
 *   
 *   $flight->restore();
 */

