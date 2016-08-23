<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('street_address', 80)->nullable();
            $table->string('city', 80)->nullable();
            $table->string('state', 80)->nullable();
            $table->string('zip')->nullable();
            $table->boolean('is_occ_member')->nullable();
            $table->integer('total_volunteer_hrs')->nullable();

            $table->timestamps();

            // foreign keys
            $table->integer('membership_id')->unsigned()->nullable();
            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('set null');
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
        //
        DB::raw("alter table `user_profiles` drop foreign key `user_profiles_membership_id_foreign'");
        Schema::table('user_profiles', function ($table) {
            $table->dropForeign('user_profiles_user_id_foreign');
        });
        Schema::drop('user_profiles');
    }


}
