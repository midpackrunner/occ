<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
	protected $fillable = [
		'first_name',
		'last_name'
	];

	public function appointments() {
		return $this->hasMany('App\Appointment');
	}
}
