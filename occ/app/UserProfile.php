<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon;
class UserProfile extends Model
{
    //

  	protected $fillable = [
  		'first_name', 'last_name', 'street_address',
  		'city', 'state', 'zip', 'is_occ_member',
  		'membership_id', 'volunteer_hrs',
  	];

  	/**
  	 * Returns only those user_profiles that are
  	 * current members.
  	 * @return <Model Group of type UserProfile
  	 */
  	public function scopeIsMember($query) 
    {
  		return $query->where('is_occ_member', '=', 1);
  	}

    /** Returns Regular Members only **/
    public function scopeIsRegularMember($query)
    {
      return $query->whereExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('memberships')
                      ->whereRaw('user_profiles.membership_id = memberships.id
                                  AND memberships.membership_type_id < 4');
              });
    }

    /** Returns Student Members only **/
    public function scopeIsStudentMember($query)
    {
      return $query->whereExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('memberships')
                      ->whereRaw('user_profiles.membership_id = memberships.id
                                  AND memberships.membership_type_id = 4');
              });
    }

    /** Returns User_Profiles that have expired memberships **/
    public function scopeHasExpiredMembership($query)
    {
      return $query->whereExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('memberships')
                      ->whereRaw('user_profiles.membership_id = memberships.id
                                  AND memberships.end_date < \'' . Carbon::now() . '\'');
              });
    }

    /** Returns membership **/
    public function membership()
    {
        return $this->belongsTo('App\Membership', 'membership_id');
    }

    /** Returns the user (i.e. log on credentials) **/
    public function user()
    {
      
      return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function phone_numbers() 
    {
      return $this->belongsToMany('App\PhoneNumber',
                                  'phone_number_user_profile')->withTimestamps();
    }

    public function interests()
    {
      return $this->belongsToMany('App\Interest', 'interest_user_profile', 'user_profile_id', 'interest_id')->withTimestamps();
    }

    public function special_skill()
    {
      return $this->hasOne('App\SpecialSkill');
    }

    public function sponsors()
    {
      return $this->hasMany('App\MembershipSponsor');
    }

    public function volunteer_hours()
    {
      return $this->hasMany('App\VolunteerHour');
    }

    public function survey_answer()
    {
      return $this->hasOne('App\SurveyAnswer');
    }

}
