<?php

use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Instructor::create([
			'first_name' => 'Susan',
			'last_name'  => 'Millican',
			'biography_id' => 1,
		]);

		App\Instructor::create([
			'first_name' => 'Fay',
			'last_name'  => 'Taylor',
			'biography_id' => 2,
		]);

		App\Instructor::create([
			'first_name' => 'Sharen',
			'last_name'  => 'and Quinn',
			'biography_id' => 3,
		]);

		App\Instructor::create([
			'first_name' => 'Mary',
			'last_name'  => 'Lujan',
			'biography_id' => 4,

		]);

		App\Instructor::create([
			'first_name' => 'JoAnne',
			'last_name'  => 'Davis',
			'biography_id' => 5,

		]);

		App\Instructor::create([
			'first_name' => 'Carol',
			'last_name'  => 'Wetzel',
			'biography_id' => 6,

		]);

		App\Instructor::create([
			'first_name' => 'Katherine',
			'last_name'  => 'Taylor-Worth',
			'biography_id' => 7,

		]);

		App\Instructor::create([
			'first_name' => 'Laurie',
			'last_name'  => 'Thompson',
			'biography_id' => 8,

		]);

		App\Instructor::create([
			'first_name' => 'Julia',
			'last_name'  => 'Gregory',
			'biography_id' => 9,
		]);
    }
}
