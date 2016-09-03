<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $fillable = [
		'shots_verified', 'path_to_medical_records', 'pet_id',
		'shots_expire',
    ];

    public function pet() {
    	return $this->belongsTo('App\Pet');
    }
}
