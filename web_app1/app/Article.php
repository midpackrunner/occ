<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {
	// supply on those fields that should be update-able
	protected $fillable = [
		'title',
		'body',
		'published_at'
	];
}
