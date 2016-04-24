<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {
	// Fields that can be edited
	protected $fillable = [
		'task_description',
		'task_summary'
	];

	/**
	 * By default, laravel will map new model names to table names with
	 * a Singular->Plural mapping.
	 *
	 * However, you can specify the table like so
	 */
	protected $table = 'tasks';

}
