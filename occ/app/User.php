<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'fillable', 'roles_id',
        'has_logged_in_once',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function scopeOrderByLName($query)
    {
        return $query->join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
                     ->orderBy('user_profiles.last_name', 'asc');
    }

    /**
     * Returns the user_profile belonging to this User
     *
     * @return <Model> UserProfile
     */
    public function user_profile() {
        return $this->hasOne('App\UserProfile', 'user_id');
    }

    /**
     * Return the user's role
     *
     * @return <Model> Role object
     */
    public function role() {
        return $this->belongsTo('App\Role', 'roles_id');
    }

    public function instructor() {
        return $this->hasOne('App\Instructor');
    }
    /**
     * Returns true if the user is an admin, otherwise returns
     * false.
     */
    public function isAdmin() {
        if ($this->role->type == 'admin') {
            return true;
        }
        return false;
    }

    public function isInstructor() {
        if ($this->role->type == 'instructor') {
            return true;
        }
        return false;
    }

    public function pets() {
        return $this->hasMany('App\Pet');
    }

    public function count_pets_with_expired_shots() {
        $cnt = 0;
        foreach ($this->pets as $pet) {
            $max_expired = $pet->med_records->max('shots_expire');
            if ($max_expired < Carbon::now()) {
                $cnt++;
            }
        }
        return $cnt;
    }

    public function has_pet_with_expired_shots() {
        if($this->count_pets_with_expired_shots() > 0) {
            return true;
        }
        return false;
    }
    /**
     * Returns boolean if the User has signed up for a class from the
     * session prior to that given by $session_id
     *
     * @param interger   $year        The year
     * @param integer  $session_id  The session identifier
     *
     * @return     boolean  True if has successive class, False otherwise.
     * @pre Assumption: 7 sessions in a year
     */
    public function hasSuccessiveClass($year, $session_id)
    {
        $result = false;
        foreach($this->pets as $pet) {
            foreach ($pet->completed_classes as $class) {
                if ($session_id != 1) {
                    if($class->session == ($session_id - 1) && 
                        substr($class->begin_date, 0, 4) == $year) {
                        $result = true;
                    }
                } else {    // compare to the previous year, last session
                    if($class->session == 7 && 
                        substr($class->begin_date, 0, 4) == $year - 1)
                        $result = true;
                }
            }
        }
        return $result;
    }

    /**
     * Checks if user has taken 5 or more classes.  A grandfathered_in column
     * has been added for pre-existing members.
     *
     * @return     boolean  True if has five or more classes, False otherwise.
     */
    public function hasFiveOrMoreClasses()
    {
        if ($this->grandfathered_in) {
            return true;
        }
        $total_classes = 0;
        foreach($this->pets as $pet) {
            foreach ($pet->completed_classes as $class) {
                $total_classes += 1;
            }
            if ($total_classes >= 5) {
                return true;
            }
        }
        return false;        
    }
    /**
     * Returns all the pets belonging to this user that
     * have not taken a particular class
     *
     * @param <Classes Object>  $class  The class under question
     *
     * @return array of Pet Objects that has not taken the course
     * If all pets have taken the class then it returns null  
     */
    public function pets_not_taken_class($class)
    {
        $pet_lst = [];

        foreach($this->pets as $pet) {
            $has_not_taken = true;
            foreach($pet->classes as $a_class) {
                if ($class->id == $a_class->id) {
                    $has_not_taken = false;
                }
            }
            if ($has_not_taken) {
                array_push($pet_lst, $pet);
            }    
        }
        if (count($pet_lst) == 0) return null;

        return $pet_lst;        
    }
}
