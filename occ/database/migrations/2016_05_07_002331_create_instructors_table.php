<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructors', function (Blueprint $table) {
            $table->softDeletes();
            $table->increments('id');
            $table->timestamps();
            $table->string('first_name', 50);
            $table->string('last_name', 50);

            //foreign key
            $table->integer('biography_id')->unsigned();
            $table->foreign('biography_id')
                  ->references('id')->on('biographies')
                  ->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instructors', function ($table) {
            $table->dropForeign('instructors_user_id_foreign');
        });
        Schema::drop('instructors');
    }
}
