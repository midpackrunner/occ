<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biography extends Model
{
    protected $fillable = [
    	'bio', 'path_to_pic'
    ];

    public function instructor()
    {
    	return $this->hasOne('App\Instructor');
    }

}
