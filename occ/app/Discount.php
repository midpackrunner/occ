<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
  	protected $fillable = [
  		'type', 'description', 'regular_member_discount',
  		'five_or_more_discount', 'successive_class_discount'
  	];

  	protected $table = 'discount_rates';


  	public function classes_details() {
  		return $this->hasMany('App\ClassesDetail', 'discount_rates_id');
  	}
}
