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
