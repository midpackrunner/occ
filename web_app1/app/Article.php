<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Article extends Model {
	// supply on those fields that should be update-able
	protected $fillable = [
		'title',
		'body',
		'published_at',
		'user_id' // temp !!!
	];

	/**
	 * Naming convention important !!!
	 * 
	 * scopeNameOfQuery.
	 * see index function of ArticlesController.
	 * 
	 * Filters and returns only those articles
	 * with a published_at date less than now.
	 *
	 * @param      <type>  $query  (description)
	 */
	public function scopePublished($query) {
		$query->where('published_at', '<=', Carbon::now());
	}

	/**
	 * Must use the following naming convention:
	 * 
	 *  setNameOfColumnAttribute
	 *  
	 *  Note: if the column name has underscores, it
	 *  translates into camel case.
	 *
	 * @param      <type>  $date   (description)
	 */
	public function setPublishedAtAttribute($date) {
		$this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);
	}

	/**
	 * You can change the name if you want.  User was just
	 * used for clarity. Could just as easliy used writer
	 * or author.
	 *
	 * @return     <type>
	 */
	public function user() {
		return $this->belongsTo('App\User');
	}
}
