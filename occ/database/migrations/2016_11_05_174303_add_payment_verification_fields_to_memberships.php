<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentVerificationFieldsToMemberships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('memberships', function ($table) {
            $table->boolean('pay_verified')->default(false);
            $table->string('pay_verified_by')->default('n/a');
            $table->date('verified_on')->nullable();

        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('memberships', function ($table) {
            $table->dropColumn('pay_verified');
            $table->dropColumn('pay_verified_by');
            $table->dropColumn('verified_on');
        }); 
    }
}
