<?php

use Illuminate\Database\Seeder;
use App\UserProfile;
class PhoneNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user_profiles = App\UserProfile::all();

    	$count = count($user_profiles);

        $phone_numbers = factory(App\PhoneNumber::class, $count)->make();

        $count = $count - 1;
        foreach ($phone_numbers as $phone_number) {
        	$phone_number->save();
        	$user_profiles[$count]->phone_numbers()->attach($phone_number->id);
	        $count = $count - 1;
        }
    }
}
