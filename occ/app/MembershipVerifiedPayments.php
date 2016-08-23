<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipVerifiedPayments extends Model
{
    
    protected $fillable = [
    	'date_verified', 'verified_by',
    	'invoice',
    ];

    public function membership()
    {
    	return $this->belongsTo('App\Membership',
    							'membership_id');
    }

    
}
