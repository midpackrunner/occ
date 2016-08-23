<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeyMemberships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // add foreign key from memberships table     
        Schema::table('memberships', function ($table) {
            $table->foreign('membership_type_id')
                  ->references('id')->on('membership_types')
                  ->onDelete('set null');
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
            $table->dropForeign('memberships_membership_type_id_foreign');
        });
    }
}
