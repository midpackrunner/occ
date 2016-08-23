<?php

use Illuminate\Database\Seeder;

class UserAndUserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create one admin user
        $c_user = App\User::create([
            'email' => 'cmbonham@hotmail.com',
            'password' =>  bcrypt('password'),
            'roles_id' => '2',
            'has_logged_in_once' => '1',
        ]);

        $c_user_profile = factory(App\UserProfile::class, 1)->make();
        $c_user_profile->user_id = $c_user->id;
        $c_user_profile->is_occ_member = true;
        $c_user_profile->save();
        
        $numberOfUsers = 18;
        // create users
        $users = factory(App\User::class, $numberOfUsers)->make();
        foreach ($users as $user) {
            $user->save();
        }


        $index = $numberOfUsers;
        // create user profiles
        $user_profiles = factory(App\UserProfile::class, $numberOfUsers)->make();
        foreach ($user_profiles as $user_profile) {
            $user_profile->user_id = App\User::find($index)->id;
            $user_profile->save();
            $index = $index - 1;
        }

        App\User::create([
            'email' => 'jbob@example.com',
            'password' =>  bcrypt('password'),
            'roles_id' => '1',
            'has_logged_in_once' => '1',
        ]);
            

            $user_profile->user_id = App\User::find(20)->id;
            $user_profile->save();


    }
}
