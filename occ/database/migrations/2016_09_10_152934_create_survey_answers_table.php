<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('response');
            $table->string('details')->nullable();

            $table->integer('user_profile_id')->nullable()->unsigned();
            $table->foreign('user_profile_id')
                  ->references('id')->on('user_profiles')
                   ->onDelete('set null');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('survey_answers', function ($table) {
            $table->dropForeign('survey_answers_user_profile_id_foreign');
        });
        Schema::drop('survey_answers');
    }
}
