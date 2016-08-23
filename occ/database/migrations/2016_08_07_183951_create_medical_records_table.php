<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('pet_id')->unsigned()->nullable();
            $table->boolean('shots_verified')->default(0);

            // store medical records in separate folder
            $table->string('path_to_medical_record')->nullable();

            $table->foreign('pet_id')
                  ->references('id')->on('pets')
                  ->onDelete('set null');
            $table->softDeletes();   // use withTrashed() to get all
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medical_records', function ($table) {
            $table->dropForeign('medical_records_pet_id_foreign');
        });
        Schema::drop('medical_records');
    }
}
