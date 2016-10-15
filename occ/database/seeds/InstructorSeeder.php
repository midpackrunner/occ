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
			'user_id' => App\User::where('email', 'sablmillican@gmail.com')
						 ->first()->id,
		]);

		App\Instructor::create([
			'first_name' => 'JoAnne',
			'last_name'  => 'Davis',
			'biography_id' => 5,
			'user_id' => App\User::where('email', 'jldavis012@yahoo.com')
						 ->first()->id,

		]);

		App\Instructor::create([
			'first_name' => 'Julia',
			'last_name'  => 'Gregory',
			'biography_id' => 9,
			'user_id' => App\User::where('email', 'jmg@tnaqua.org')
						 ->first()->id,
		]);
		
		App\Instructor::create([
			'first_name' => 'Mary',
			'last_name'  => 'Lujan',
			'biography_id' => 4,
			'user_id' => App\User::where('email', 'msbrett@87gdesign.com')
						 ->first()->id,

		]);

		App\Instructor::create([
			'first_name' => 'Linda',
			'last_name'  => 'Maddox',
			'biography_id' => 10,
			'user_id' => App\User::where('email', 'stellarbt@charter.net')
						 ->first()->id,

		]);

		App\Instructor::create([
			'first_name' => 'Jamie',
			'last_name'  => 'Morgan',
			'biography_id' => 11,
			'user_id' => App\User::where('email', 'idreamofpinkcars@aol.com')
						 ->first()->id,

		]);

		App\Instructor::create([
			'first_name' => 'Fay',
			'last_name'  => 'Taylor',
			'biography_id' => 2,
			'user_id' => App\User::where('email', 'geofay@bellsouth.net')
						 ->first()->id,
		]);

		App\Instructor::create([
			'first_name' => 'Laurie',
			'last_name'  => 'Thompson',
			'biography_id' => 8,
			'user_id' => App\User::where('email', 'mountainbirddogs@aol.com')
						 ->first()->id,

		]);

		App\Instructor::create([
			'first_name' => 'Debbie',
			'last_name'  => 'Tuthill',
			'biography_id' => 12,
			'user_id' => App\User::where('email', 'dltuthill@epbfi.com')
						 ->first()->id,

		]);

		App\Instructor::create([
			'first_name' => 'Carol',
			'last_name'  => 'Wetzel',
			'biography_id' => 6,
			'user_id' => App\User::where('email', 'carolwetzel3@gmail.com')
						 ->first()->id,

		]);

		App\Instructor::create([
			'first_name' => 'Katherine',
			'last_name'  => 'Taylor-worth',
			'biography_id' => 7,
			'user_id' => App\User::where('email', 'ktw@taylorworth.com')
						 ->first()->id,

		]);

		// App\Instructor::create([        // Missing User (email)
		// 	'first_name' => 'Sharen',
		// 	'last_name'  => 'and Quinn',
		// 	'biography_id' => 3,
		//  			'user_id' => App\User::where('email', 'sablmillican@gmail.com')
		//				 ->first()->id,
		// ]);

    }
}
