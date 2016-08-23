<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classes', function ($table) {
            $table->foreign('class_details_id')
                  ->references('id')->on('classes_details')
                  ->onDelete('set null');
        });

        Schema::table('pets', function ($table) {
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });

        Schema::table('user_profiles', function ($table) {
            $table->foreign('membership_id')
                  ->references('id')->on('memberships')
                  ->onDelete('set null');
        });
        
        Schema::table('users', function ($table) {
            $table->foreign('roles_id')
                  ->references('id')->on('roles')
                  ->onDelete('cascade');
        });
        
        Schema::table('classes_pet', function ($table) {
            $table->foreign('pet_id')
                  ->references('id')->on('pets')
                  ->onDelete('cascade');
            $table->foreign('classes_id')
                  ->references('id')->on('classes')
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

        Schema::table('classes', function ($table) {
            $table->dropForeign('classes_class_details_id_foreign');
        });
        Schema::table('users', function ($table) {
            $table->dropForeign('users_roles_id_foreign');
        });
        Schema::table('classes_pet', function ($table) {
            $table->dropForeign('classes_pet_pet_id_foreign');
            $table->dropForeign('classes_pet_classes_id_foreign');
        });
        Schema::table('instructors', function ($table) {
            $table->dropForeign('instructors_biography_id_foreign');
        });  
    }
}