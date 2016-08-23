<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_skills', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('skill_description');
            $table->timestamps();

            // foreign key
            $table->integer('user_profile_id')->unsigned();
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
        Schema::table('special_skills', function ($table) {
            $table->dropForeign('special_skills_user_profile_id_foreign');
        });        
        Schema::drop('special_skills');
    }
}
