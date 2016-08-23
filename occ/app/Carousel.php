<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    //
    protected $fillable = [
    	'caption', 'path_to_img'
    ];
}
