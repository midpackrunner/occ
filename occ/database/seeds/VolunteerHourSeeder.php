<?php

use Illuminate\Database\Seeder;

class VolunteerHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\VolunteerHour::create([
			'description' => 'Helped pick up dog poop yesterday!',
			'hours' => 4,
			'user_profile_id' => '19'
		]);

        App\VolunteerHour::create([
			'description' => 'Volunteered doing something',
			'hours' => 2,
			'user_profile_id' => '19'
		]);

        App\VolunteerHour::create([
			'description' => 'Built a website',
			'hours' => 4,
			'user_profile_id' => '1'
		]);
		App\VolunteerHour::sync_hours(App\User::findOrFail(1));
		App\VolunteerHour::sync_hours(App\User::findOrFail(20));

    }
}
