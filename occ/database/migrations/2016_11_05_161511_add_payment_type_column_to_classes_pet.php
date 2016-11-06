<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentTypeColumnToClassesPet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classes_pet', function (Blueprint $table) {
            $table->string('pay_method')->default('n/a');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('classes_pet', function ($table) {
        $table->dropColumn('pay_method');
      });
    }
}
