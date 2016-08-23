<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes_instructor', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            //foreign keys            
            $table->integer('classes_id')->unsigned();
            $table->integer('instructor_id')->unsigned();

            $table->foreign('classes_id')->references('id')
                  ->on('classes')
                  ->onDelete('cascade');
            $table->foreign('instructor_id')->references('id')
                  ->on('instructors')
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
        Schema::table('classes_instructor', function ($table) {
            $table->dropForeign('classes_instructor_classes_id_foreign');
        });
        Schema::table('classes_instructor', function ($table) {
            $table->dropForeign('classes_instructor_instructor_id_foreign');
        });
        Schema::drop('classes_instructor');
    }
}
