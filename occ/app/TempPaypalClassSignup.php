<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempPaypalClassSignup extends Model
{
    protected $fillable = [
		'token','pet_id', 'class_id', 'pay_amount'
    ];
}
