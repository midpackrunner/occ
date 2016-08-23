<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrereqClassesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes_details_prereqs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            //foreign keys            
            $table->integer('classes_details_id')->unsigned();
            $table->integer('pre_req_id')->unsigned();

            $table->foreign('classes_details_id')->references('id')
                  ->on('classes_details')
                  ->onDelete('cascade');
            $table->foreign('pre_req_id')->references('id')
                  ->on('classes_details')
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
        Schema::table('classes_details_prereqs', function ($table) {
            $table->dropForeign('classes_details_prereqs_classes_details_id_foreign');
        });
        Schema::table('classes_details_prereqs', function ($table) {
            $table->dropForeign('classes_details_prereqs_pre_req_id_foreign');
        });
        Schema::drop('classes_details_prereqs');
    }
}
