<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->increments('id');
            $table->softDeletes();
            $table->timestamps();
            $table->string('day_of_week', 15);
            $table->date('begin_date');
            $table->date('end_date');
            $table->string('entrance', 30);
            $table->integer('capacity');
            $table->integer('vacant')->nullable();
            $table->integer('on_hold')->nullable();
            $table->integer('class_details_id')->unsigned()->nullable();
            $table->string('session');
            $table->string('time');
            $table->string('is_open');
            // this unique may throw an error.  I did it manually
            $table->unique(array('begin_date', 'end_date', 'class_details_id', 'session', 'time', 'day_of_week'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('classes');
    }
}
