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
        Schema::table('memberships', function ($table) {
            $table->boolean('verified_payment')->default(false);
        });

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
        Schema::table('memberships', function ($table) {
            $table->dropColumn('verified_payment');
        });

        Schema::table('classes_pet', function ($table) {
            $table->dropColumn('verified_payment');
        });
    }
}
