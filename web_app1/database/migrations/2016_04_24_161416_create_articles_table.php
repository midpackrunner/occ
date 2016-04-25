<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('articles', function (Blueprint $table) {
				$table->increments('id');
				$table->string('title');
				$table->mediumText('body');
				$table->timestamp('published_at');
				$table->timestamps();
				$table->integer('user_id')->unsigned();

				$table->foreign('user_id')
					  ->references('id')
					  ->on('users')
					  ->onDelete('cascade');
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('articles');
	}
}
