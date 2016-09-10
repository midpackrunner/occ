<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name', 45);
            $table->string('gender', 6);
            $table->boolean('is_spayed_neutered');
            $table->date('birth_date')->nullable();
            // age expected to be in weeks
            $table->double('age')->nullable();
            $table->string('breed');

            //foreign keys            
            $table->integer('user_id')->unsigned();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::raw("alter table `pets` drop foreign key `pets_user_id_foreign'");
        Schema::drop('pets');
    }
}
