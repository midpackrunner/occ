<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_verified_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('membership_id')->unsigned();
            $table->date('date_verified');
            $table->string('verified_by');
            $table->string('invoice')->nullable();

            $table->foreign('membership_id')
                  ->references('id')->on('memberships')
                  ->onDelete('cascade');
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
        Schema::table('membership_verified_payments', function ($table) {
            $table->dropForeign('membership_verified_membership_id_foreign');
        });
        Schema::drop('membership_verified_payments');
    }
}
