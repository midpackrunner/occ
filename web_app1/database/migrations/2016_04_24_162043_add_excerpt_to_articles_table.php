<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddExcerptToArticlesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('articles', function (Blueprint $table) {
				$table->text('excerpt')->nullable();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('articles', function (Blueprint $table) {
				//
				$table->dropColumn('excerpt');

			});
	}
}
