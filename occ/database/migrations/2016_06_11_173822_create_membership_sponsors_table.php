<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_sponsors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sponsor_name', 150);
            $table->integer('user_profile_id')->unsigned();
            $table->timestamps();

            //foreign key
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
        Schema::table('membership_sponsors', function ($table) {
            $table->dropForeign('membership_sponsors_user_profile_id_foreign');
        });
        Schema::drop('membership_sponsors');
    }
}
