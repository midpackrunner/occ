<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDiscountIdColumnToClassDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classes_details', function ($table) {
            $table->integer('discount_rates_id')->unsigned()->nullable();

            $table->foreign('discount_rates_id')->references('id')
                  ->on('discount_rates')->onDelete('set null');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('classes_details', function ($table) {
            $table->dropForeign('classes_details_discount_rates_id_foreign');
            $table->dropColumn('discount_rates_id');
        });     
    }
}
