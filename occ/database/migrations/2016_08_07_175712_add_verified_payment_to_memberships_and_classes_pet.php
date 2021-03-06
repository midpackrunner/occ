<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVerifiedPaymentToMembershipsAndClassesPet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('classes_pet', function ($table) {
            $table->boolean('verified_payment')->default(false);
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
            $table->dropColumn('verified_payment');
        });
    }
}
