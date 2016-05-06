<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	// Add Table Seeders here
        $this->call(DoctorsTableSeeder::class);
        $this->call(AppointmentsTableSeeder::class);
    }
}
