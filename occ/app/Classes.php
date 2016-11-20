<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Classes extends Model
{
	use SoftDeletes;  //<-- Retain DATA.

    protected $table = 'classes';
    protected $fillable = [
		'day_of_week', 'begin_date', 'end_date' , 'session',
		'entrance', 'capacity', 'vacant', 'on_hold',
		'time', 'class_details_id', 'is_open'
    ];

    // use $classes->trashed() boolean to see if an item is soft deleted
    protected $dates = ['deleted_at'];

    /**
     * Scope: only those classes that fall in (a) a particular session AND
     * (b) a particular year.
     */
    public function scopeOfSession($query, $session, $year)
    {
        return $query->where([
                    ['session', $session],
                    ['begin_date', '>=', Carbon::create($year, 1, 1)->toDateString()],
                    ['begin_date', '<=', Carbon::create($year + 1, 1, 1)->toDateString()],
               ]);

    }

    // return only those classes whose end date is less than today
    public function scopeUpComing($query)
    {
    	return $query->where('end_date', '>=', Carbon::today());
    }

    /**
     * Scope only those classes whose end date is at least out
     * by two weeks from today.
     * TODO: Hotfixed this to extend to three weeks, need to correct
     * the name of the function
     */
    public function scopeTwoWeeksOut($query)
    {
        return $query->where('end_date', '>=', Carbon::today()->subWeeks(3));
    }

    /**
     * Scope: only those classes that are open to the public
     */
    public function scopeIsOpen($query)
    {
        return $query->where('is_open', '=', 'yes');
    }

    /**
     * Scope: those classes that have vacany still
     */
    public function scopeHasRoom($query)
    {
        return $query->where('vacant', '>', 0);
    }

    /**
     * Scope to classes that can be signed up for.  
     * Members can only sign up if (a) the class is only a week into the
     * schedule, and (b) depending on membership type, can sign up given
     * a number of weeks prior to the beginning of class.  Student
     * members can sign up 10 days prior, while all others can sign up
     * 14 days prior.
     */
    public function scopeCanSignUp($query, $user)
    {
        $membership = $user->user_profile->membership->membership_type->name;
        if ($membership == 'student') {
            $i = 10;
        }else {
            $i = 14;
        }
        return $query->where('begin_date', '>=', Carbon::today()->subWeeks(1))
                ->where('begin_date', '<=', Carbon::today()->addDays($i));
    }

    /**
     * Scope classes and pets that have claimed ATLEAST a certain number
     * of hours.  The default is 4.
     */
    public function scopeNumberOfClaimedHours($query, $hours=null)
    {
        if ($hours === null) {
            $hours = 4;             // default to 4 hours
        }
        $pivot = $this->pets()->getTable();
        $query->whereHas('pets', function ($q) use ($hours, $pivot) {
            $q->where("{$pivot}.logged_hours", ">=", $hours);
        });
    }

    /**
     * Scope classes by Instructor
     */
    public function scopeHasInstructor($query,$inst_id)
    {
        $pivot = $this->instructors()->getTable();
        $query->whereHas('instructors', function ($q) use ($inst_id, $pivot) {
            $q->where("{$pivot}.instructor_id", $inst_id);
        });
    }
    
    // return details of a class
    public function details()
    {
        return $this->belongsTo('App\ClassesDetail', 'class_details_id');
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
                    ->withPivot('is_completed', 'logged_hours', 'verified_payment', 'pay_method')
                    ->withTimestamps();
    }

    // Returns attendance (i.e. logged hours by attendance date)
    public function attendees()
    {
        return $this->belongsToMany('App\Pet', 'class_attendances')
            ->withPivot('attended_date')
            ->withTimestamps();
    }
    // returns the string rep. of a day of the week
    public function get_day()
    {
        return $this->day_of_week;
    }

    // get the maximum session number.  As of now, OCC has a max of 7,
    // but this value is used throughout different views, and needs
    // to be dynamically changed.
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

