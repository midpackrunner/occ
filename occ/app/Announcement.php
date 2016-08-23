<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Announcement extends Model
{
    
    protected $fillable = [
    	'title', 'description', 'publish_on',
    	'remove_on'
    ];


    public function scopeIsPublished($query)
    {
    	return $query->where('publish_on', '<=', Carbon::now());
    }

    public function scopeIsNotRemoved($query)
    {
    	return $query->where('remove_on', '>', Carbon::now());
    }
}
