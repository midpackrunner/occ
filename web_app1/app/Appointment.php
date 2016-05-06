<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    // to specify the table name explicitly
    protected $table = 'appointments';

    // Overriding the default, implicit primary key of id
    // protected $primaryKey = "unique_primary_key_name"
    // 
    
    protected $fillable = [
    	'appointment_name', 'appointment_date', 'doctor_id'
    ];

    // set the create and updated timestamps
    //protected $timestamps = true;


    public function doctor() {
        return $this->belongsTo('App\Doctor');
    }
}
