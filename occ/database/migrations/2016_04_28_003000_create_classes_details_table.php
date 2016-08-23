<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes_details', function (Blueprint $table) {
            $table->increments('id');
            $table->softDeletes();
            $table->string('title', 80);
            $table->longText('description');
            $table->decimal('cost', 6, 2);
            $table->boolean('is_active')->default(1);
            $table->decimal('minimum_age_requirement', 4, 2)  //<- in weeks
                  ->nullable();
            $table->decimal('maximum_age_requirement', 4, 2)  //<- in weeks
                  ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('classes_details');
    }
}

