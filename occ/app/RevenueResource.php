<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevenueResource extends Model
{
    protected $fillable = [
		'resource', 'description',
    ];
}
