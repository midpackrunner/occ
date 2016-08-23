<?php

use Illuminate\Database\Seeder;

class MembershipVerifiedPaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$user = App\User::findOrFail(1);

        $payment_proof = App\MembershipVerifiedPayments::create([
			'date_verified' => '2018-01-01',
			'verified_by' => 'me@example.com',
			'membership_id' => $user->user_profile->membership->id
		]);

		$user->user_profile->membership
						   ->verified_payments()->save($payment_proof);
    }
}
