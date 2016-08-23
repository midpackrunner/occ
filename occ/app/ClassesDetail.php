<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassesDetail extends Model
{
    use SoftDeletes;

    protected $fillable = [
		'title', 'description',
		'cost', 'is_active', 'minimum_age_requirement',
		'maximum_age_requirement'
    ];

    protected $dates = ['deleted_at'];

    public function pre_reqs()
    {
    	return $this->belongsToMany('App\ClassesDetail', 'classes_details_prereqs',
    						 'classes_details_id', 'pre_req_id')->withTimestamps();
    }

    public function classes()
    {
        return $this->hasMany('App\Classes', 'class_details_id');
    }

    public function scopeIsActive($query)
    {
        return $query->where('is_active', '=', true);
    }

}
