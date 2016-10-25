<?php

use Illuminate\Database\Seeder;

class DiscountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Discount::create([
			'type' => 'agility_discount', 
			'description' => 'Discounts that apply to agility classes', 
			'regular_member_discount' => 5.00,
	  		'five_or_more_discount' => 35.00, 
	  		'successive_class_discount' => 10.00
		]);
        App\Discount::create([
			'type' => 'regular_class_discount', 
			'description' => 'Discounts that apply to regular classes', 
			'regular_member_discount' => 5.00,
	  		'five_or_more_discount' => 30.00, 
	  		'successive_class_discount' => 10.00
		]);
        App\Discount::create([
			'type' => 'flat_rate_discount', 
			'description' => 'For classes that only offer a $10 regular member discount', 
			'regular_member_discount' => 10.00,
	  		'five_or_more_discount' => 0.00, 
	  		'successive_class_discount' => 0.00
		]);
    }
}
