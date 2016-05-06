<?php

use Illuminate\Database\Seeder;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Clean out table before seeding
        DB::table('appointments')->delete();
        DB::statement('alter table appointments auto_increment=1;');

        // Using factory using fzaninotto/faker
        // See database/factories/ModelFactory.php for creating a factory
        $apps = factory(App\Appointment::class, 10)->make();
        foreach ($apps as $app) {
            $app->save();
        }

        // Create one appointment
		DB::table('appointments')->insert([
        	'appointment_name' => 'App9',
        	'appointment_date' => '2016-05-15',
            'appointment_time' => '09:30:00',
            'doctor_id' => 2,

        ]);

        DB::table('appointments')->insert([
            'appointment_name' => 'App9',
            'appointment_date' => '2016-06-15',
            'appointment_time' => '10:30:00',
            'doctor_id' => 2,
        ]);

        DB::table('appointments')->insert([
            'appointment_name' => 'App9',
            'appointment_date' => '2016-07-15',
            'appointment_time' => '13:30:00',
            'doctor_id' => 2,
        ]);

        DB::table('appointments')->insert([
            'appointment_name' => 'App9',
            'appointment_date' => '2016-05-11',
            'appointment_time' => '14:30:00',
            'doctor_id' => 2,
        ]);

    }
}
