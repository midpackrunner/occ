<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VolunteerHour extends Model
{
  	protected $fillable = [
  		'description', 'hours', 'is_sync'
  	];

  	/**
  	 * Return only those with non zero hours.
  	 */
  	public function scopeHasHours($query)
  	{
  		return $query->where('hours', '!=', 0);
  	}


  	public function user_profile()
  	{
  		return $this->belongsTo('App\UserProfile');
  	}

  	/*========================================
  	=            Static Functions            =
  	========================================*/

	// sync volunteer hours to user's profile  	
  	public static function sync_hours($user)
  	{
  		$user_prf = $user->user_profile;
  		$total_hrs = $user_prf->total_volunteer_hrs;
  		foreach ($user_prf->volunteer_hours as $vol_hr) {
  			if(! $vol_hr->is_sync)
  			{
	  			$total_hrs += $vol_hr->hours;
  				$vol_hr->is_sync = 1;
  				$vol_hr->save();
  			}
  		}
  		$user_prf->total_volunteer_hrs = $total_hrs;
  		$user_prf->save();

  	}
  	// deducts hours from user's profile
  	public static function deduct_hours($user, $hours)
  	{
  		$user_prf = $user->user_profile;
  		if($user_prf->total_volunteer_hrs < $hours)
  		{
  			return false;
  		}
  		$user_prf->total_volunteer_hrs -= $hours;
  		$user_prf->save();

  		return true;
  	}

  	// checks if a user has enough hours
  	public static function has_enough_hours($user, $hours)
  	{
  		$user_prf = $user->user_profile;
  		if($user_prf->total_volunteer_hrs < $hours)
  		{
  			return false;
  		}
  		return true;  		
  	}
  	/*=====  End of Static Functions  ======*/
}