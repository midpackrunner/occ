<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('pet_id')->unsigned();
            $table->integer('classes_id')->unsigned();
            $table->date('attended_date');

            // foreign keys
            $table->foreign('pet_id')
                  ->references('id')->on('pets')
                  ->onDelete('cascade');
            $table->foreign('classes_id')
                  ->references('id')->on('classes')
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
        Schema::table('class_attendances', function ($table) {
            $table->dropForeign('class_attendances_pet_id_foreign');
        });
        Schema::table('class_attendances', function ($table) {
            $table->dropForeign('class_attendances_classes_id_foreign');
        });
        Schema::drop('class_attendances');
    }
}
