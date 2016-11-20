<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClassOverrideFieldToClassesPet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pets', function ($table) {
            $table->integer('overrride_class_id')->default(0);
        });         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pets', function ($table) {
            $table->dropColumn('overrride_class_id');
        }); 
    }
}
