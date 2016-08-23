<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'type' => 'general_user',
        ]);
        DB::table('roles')->insert([
            'type' => 'admin',
        ]);
        DB::table('roles')->insert([
            'type' => 'instructor',
        ]);
    }
}
