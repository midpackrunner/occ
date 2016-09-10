<?php

use Illuminate\Database\Seeder;

class SurveyAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\SurveyAnswer::create([
			'response' => 'Vet',
			'details' => 'Gunbarrel Vet',
			'user_profile_id' => 1,
		]);

        App\SurveyAnswer::create([
			'response' => 'Newspaper',
			'user_profile_id' => 2,
		]);

		App\SurveyAnswer::create([
			'response' => 'Other',
			'details' => 'I heard it through the greate vine',
			'user_profile_id' => 3,
		]);

    }
}
