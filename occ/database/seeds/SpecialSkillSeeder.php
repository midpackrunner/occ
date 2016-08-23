<?php

use Illuminate\Database\Seeder;

class SpecialSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        App\SpecialSkill::create([
        	'skill_description' => 'I can program and build websites',
        	'user_profile_id' => 18,
    	]);
    }
}
