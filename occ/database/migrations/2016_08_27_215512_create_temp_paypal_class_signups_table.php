<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempPaypalClassSignupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_paypal_class_signups', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('token', 32);
            $table->integer('pet_id')->unsigned();
            $table->integer('class_id')->unsigned();
            $table->double('pay_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('temp_paypal_class_signups');
    }
}
