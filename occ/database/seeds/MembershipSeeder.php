<?php

use Illuminate\Database\Seeder;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\MembershipType::create([
	        'name' => 'individual',
	        'cost' => 25.00,
	        'discount_on_classes' => 5.00,
	        'description' => 'todo: get a description'
		]);

		App\MembershipType::create([
	        'name' => 'household',
	        'cost' => 35.00,
	        'discount_on_classes' => 5.00,
	        'description' => 'todo: get a description'
		]);

		App\MembershipType::create([
	        'name' => 'associate',
	        'cost' => 15.00,
	        'discount_on_classes' => 5.00,
	        'description' => 'Associate membership is a non-voting membership that carries all the other privileges of membership.'
		]);

		App\MembershipType::create([
	        'name' => 'student',
	        'cost' => 5.00,
	        'discount_on_classes' => 0.00,
	        'description' => 'todo: get a description'
		]);

		// get all users who are members
		$member_users =  App\UserProfile::ismember()->get();
		$number_of_member_users = count($member_users);

		//loop through user_profiles and add membership_id
		for ($i=0; $i < $number_of_member_users; $i++) { 
			$pay_method = 'paypal';
			if ($i % 2 == 0) {
				$pay_method = "check";
			}
	        $membership = App\Membership::create([
		        'membership_type_id' => (($i % 4) + 1),
		        'start_date' => new DateTime("2016-05-01"),
		        'end_date' =>   new DateTime("2017-05-01"),
		        'payment_method' => $pay_method,
			]);
	    	$member_users[$i]->membership_id = $membership->id;
	    	$member_users[$i]->save();    
		}

    }
}
