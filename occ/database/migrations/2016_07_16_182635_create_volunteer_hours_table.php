<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVolunteerHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volunteer_hours', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->integer('hours');
            $table->boolean('is_sync')->default(false);
            $table->timestamps();

            // foreign keys
            $table->integer('user_profile_id')->unsigned()->nullable();
            $table->foreign('user_profile_id')
                  ->references('id')->on('user_profiles')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('volunteer_hours', function ($table) {
            $table->dropForeign('volunteer_hours_user_profile_id_foreign');
        });
        Schema::drop('volunteer_hours');
    }
}
