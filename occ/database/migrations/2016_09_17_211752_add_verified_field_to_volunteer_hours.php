<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVerifiedFieldToVolunteerHours extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('volunteer_hours', function ($table) {
            $table->boolean('verified')->default(0);
            $table->string('verified_by')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('volunteer_hours', function ($table) {
            $table->dropColumn(['verified', 'verified_by']);
        });
    }
}
