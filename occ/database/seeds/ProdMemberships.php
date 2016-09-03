<?php

use Illuminate\Database\Seeder;

class ProdMemberships extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}


