<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhoneNumberUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_number_user_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('phone_number_id')->unsigned();
            $table->integer('user_profile_id')->unsigned();

            $table->foreign('phone_number_id')->references('id')
                  ->on('phone_numbers')->onDelete('cascade');

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
        Schema::drop('phone_number_user_profile');
    }
}
