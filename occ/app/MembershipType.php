<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipType extends Model
{
    
    protected $fillable = [
    	'name', 'cost', 'discount_on_classes'
    ];

    public function scopeOfType($query, $type) {
    	return $query->where('name', '=', $type);
    }

    public function memberships() {
    	return $this->hasMany('App\Membership');
    }
}
