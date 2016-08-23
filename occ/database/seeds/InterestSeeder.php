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
	        'name' => 'Publicity',
		]);
		App\Interest::create([
	        'name' => 'Newsletter',
		]);
		App\Interest::create([
	        'name' => 'Hospitality',
		]);
		App\Interest::create([
	        'name' => 'Show/match',
		]);
		App\Interest::create([
	        'name' => 'Membership',
		]);
		App\Interest::create([
	        'name' => 'Sunshine',
		]);
		App\Interest::create([
	        'name' => 'Fundraising',
		]);
		App\Interest::create([
	        'name' => 'Education',
		]);
		App\Interest::create([
	        'name' => 'Class instructor',
		]);
		App\Interest::create([
	        'name' => 'Class assistant',
		]);
    }
}
