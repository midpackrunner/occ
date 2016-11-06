<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPayMethodToMembershipVerifiedPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('membership_verified_payments', function ($table) {
            $table->string('pay_method')->nullable();
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
            $table->dropColumn('pay_method');
        });
    }
}
