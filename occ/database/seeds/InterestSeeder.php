<?php

use Illuminate\Database\Seeder;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		App\Interest::create([
	        'name' => 'Class Instructor',
		]);
		App\Interest::create([
	        'name' => 'Class Assistant',
		]);
		App\Interest::create([
	        'name' => 'County Fair',
		]);
		App\Interest::create([
	        'name' => 'Education',
		]);
		App\Interest::create([
	        'name' => 'Facilities',
		]);
		App\Interest::create([
	        'name' => 'Hospitality',
		]);
		App\Interest::create([
	        'name' => 'Membership',
		]);
		App\Interest::create([
	        'name' => 'Monthly Meeting Setup/Breakdown',
		]);
		App\Interest::create([
	        'name' => 'Publicity - Facebook, Twitter, Instagram, etc.',
		]);
		App\Interest::create([
	        'name' => 'Show/Match Volunteer',
		]);
		App\Interest::create([
	        'name' => 'Technology',
		]);
		App\Interest::create([
	        'name' => 'Trials',
		]);
		App\Interest::create([
	        'name' => 'Newsletter',
		]);

    }
}
