<?php

use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Add two pet profiles to user with id of 21
        //  21 will always be a member
        App\Pet::create([
			'name' => 'Dude',
			'gender' => 'Male',
			'is_spayed_neutered' => '1',
			'birth_date' => '2014-05-05',
			'breed' => 'bull dog',
			'user_id' => '1',
		]);
        App\Pet::create([
			'name' => 'Whopper',
			'gender' => 'Female',
			'is_spayed_neutered' => '1',
			'birth_date' => '2016-01-01',
			'breed' => 'German Sheperd',
			'user_id' => '21',
		]);

    }
}
