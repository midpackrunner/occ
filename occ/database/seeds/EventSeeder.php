<?php

use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Event::create([
			'date_of_event' => '2016-10-05',
			'title' => '2016 Rally and Obedience Trials',
			'description' => 'Our fall obedience trial will be held October 22nd and 23rd at Play Dog Excellent: which is located at 4113 Dayton Blvd., Chattanooga, TN 37415.  The closing date for the October trial is Wednesday, October 5th, 2016.

				Please note, we will be holding 2 Obedience trials and 2 Rally trials on Saturday. On Sunday, there will be 1 Obedience trial and 1 Rally trial.'
		]);

        App\Event::create([
			'date_of_event' => '2016-08-05',
			'title' => 'Scopped Out',
			'description' => 'You should not see this'
		]);
    }
}
