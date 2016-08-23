<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesPetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes_pet', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('pet_id')->unsigned();
            $table->integer('classes_id')->unsigned();
            $table->boolean('is_completed')->default(false);
            $table->integer('logged_hours')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('classes_pet');
    }
}
