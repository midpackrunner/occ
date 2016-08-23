<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('interest_user_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('interest_id')->unsigned();
            $table->integer('user_profile_id')->unsigned();

            $table->foreign('interest_id')->references('id')
                  ->on('interests')->onDelete('cascade');

            $table->foreign('user_profile_id')->references('id')
                  ->on('user_profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interest_user_profile', function ($table) {
            $table->dropForeign('interest_user_profile_interest_id_foreign');
            $table->dropForeign('interest_user_profile_user_profile_id_foreign');
        });
        Schema::drop('interest_user_profile');
        Schema::drop('interests');

    }
}
