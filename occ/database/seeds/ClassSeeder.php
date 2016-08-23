<?php

use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $class = App\Classes::create([
            'session' =>  '4',
			'day_of_week' => 'Wednesdays',
			'time' => '6:15pm - 7:15pm',
			'begin_date' =>  '2016-05-25',
			'end_date' =>    '2016-06-29', 
			'entrance' =>    'Front Entrance',
			'capacity' => 6,
			'vacant' =>   6,
			'on_hold' =>  0,
			'is_open' => 'yes',
			'class_details_id' => App\ClassesDetail::where('title', '=' , 'Better Beginning Babies')->first()->id,
        ]);
        $instructor = App\Instructor::where('last_name', '=', 'Lujan')->first();
        $class->instructors()->attach($instructor);
        $instructor = App\Instructor::where('last_name', '=', 'Thompson')->first();
        $class->instructors()->attach($instructor);


        $class = App\Classes::create([
            'session' =>  '4',
			'day_of_week' => 'Mondays',
			'time' => '6:15pm - 7:15pm',
			'begin_date' =>  '2016-05-23',
			'end_date' =>    '2016-06-27', 
			'entrance' =>    'Side Entrance',
			'capacity' => 6,
			'vacant' =>   6,
			'on_hold' =>  0,
			'is_open' => 'yes',
			'class_details_id' => App\ClassesDetail::where('title', '=' , 'AKC S.T.A.R. Puppy')->first()->id,
        ]);
        $instructor = App\Instructor::where('last_name', '=', 'Millican')->first();
        $class->instructors()->attach($instructor);    


        $class = App\Classes::create([
            'session' =>  '4',
			'day_of_week' => 'Mondays',
			'time' => '6:15pm - 7:15pm',
			'begin_date' =>  '2016-10-23',
			'end_date' =>    '2016-11-27', 
			'entrance' =>    'Side Entrance',
			'capacity' => 6,
			'vacant' =>   6,
			'on_hold' =>  0,
			'is_open' => 'yes',
			'class_details_id' => App\ClassesDetail::where('title', '=' , 'AKC S.T.A.R. Puppy')->first()->id,
        ]);
        $instructor = App\Instructor::where('last_name', '=', 'Millican')->first();
        $class->instructors()->attach($instructor);      		
    
        $class = App\Classes::create([
            'session' =>  '4',
			'day_of_week' => 'Mondays',
			'time' => '7:15pm - 8:15pm',
			'begin_date' =>  '2016-10-25',
			'end_date' =>    '2016-11-30', 
			'entrance' =>    'Front Entrance',
			'capacity' => 6,
			'vacant' =>   6,
			'on_hold' =>  0,
			'is_open' => 'yes',
			'class_details_id' => App\ClassesDetail::where('title', '=' , 'Better Beginning Babies')->first()->id,
        ]);
        $instructor = App\Instructor::where('last_name', '=', 'Lujan')->first();
        $class->instructors()->attach($instructor);
        $instructor = App\Instructor::where('last_name', '=', 'Thompson')->first();
        $class->instructors()->attach($instructor);

        $class = App\Classes::create([
            'session' =>  '4',
			'day_of_week' => 'Mondays',
			'time' => '7:15pm - 8:15pm',
			'begin_date' =>  '2016-10-25',
			'end_date' =>    '2016-11-30', 
			'entrance' =>    'Front Entrance',
			'capacity' => 6,
			'vacant' =>   6,
			'on_hold' =>  0,
			'is_open' => 'yes',
			'class_details_id' => App\ClassesDetail::where('title', '=' , 'Canine Good Citizen')->first()->id,
        ]);
        $instructor = App\Instructor::where('last_name', '=', 'Gregory')->first();
        $class->instructors()->attach($instructor); 

        $session = App\ActiveSession::create([
        	'session' => '4',
    	]);
    }
}


