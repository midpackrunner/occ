<?php

use Illuminate\Database\Seeder;

class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                // Clean out table before seeding
        DB::table('doctors')->delete();
        DB::statement('alter table doctors auto_increment=1;');

        // Using factory using fzaninotto/faker
        // See database/factories/ModelFactory.php for creating a factory
        $doctors = factory(App\Doctor::class, 20)->make();
        foreach ($doctors as $doctor) {
            $doctor->save();
        }


    }
}
