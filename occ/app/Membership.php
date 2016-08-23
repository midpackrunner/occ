<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Membership extends Model
{
    
    protected $fillable = [
    	'payment_method', 'membership_type_id',
    	'start_date', 'end_date'
    ];

    /**
     * Returns the membership_type this membership belongs to.
     * Syntax is not clear here.  The relationship is more like:
     * 
     *		"a membership is of membership_type" 
     */
    public function membership_type() 
    {
    	return $this->belongsTo('App\MembershipType', 
    							'membership_type_id');
    }

    public function user_profile() 
    {
    	return $this->hasOne('App\UserProfile');
    }

        /** Returns User_Profiles that have expired memberships **/
    public function scopeHasExpiredMembership($query)
    {
      return $query->where('end_date', '<' , Carbon::now());
    }

    public function verified_payments()
    {
        return $this->hasMany('App\MembershipVerifiedPayments');
    }
}
