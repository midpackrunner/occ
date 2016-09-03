<?php

use Illuminate\Database\Seeder;

class ProdUserandUserProfile extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sm_user = App\User::create([
            'email' => 'sablmillican@gmail.com',
            'password' =>  bcrypt('password'),
            'roles_id' => '2',
            'has_logged_in_once' => '0',
        ]);

        // 1 = ind, 2 = household, 3 = ass, 4 = student
        // 1 = general, 2 = admin, 3 = instructor
        $membership = App\Membership::create([
            'membership_type_id' => 2,
            'start_date' => new DateTime("2016-05-01"),
            'end_date' =>   new DateTime("2017-05-01"),
            'payment_method' => 'check',
        ]);

        $sm_usr_prf = App\UserProfile::create([
        	'first_name' => 'Susan',
        	'last_name' => 'Millican',
        	'street_address' => '1622 Back Valley Road',
        	'city' => 'Trenton',
        	'state' => 'Georgia',
        	'zip' => '30752',
        	'is_occ_member' => 1,
        	'membership_id' => $membership->id,
        	'user_id' => $sm_user->id,
        	'willing_to_work' => 'yes'
        ]);


        $sm_user = App\User::create([
            'email' => 'jldavis012@yahoo.com',
            'password' =>  bcrypt('password'),
            'roles_id' => '3',
            'has_logged_in_once' => '0',
        ]);

        $membership = App\Membership::create([
            'membership_type_id' => 1,
            'start_date' => new DateTime("2016-05-01"),
            'end_date' =>   new DateTime("2017-05-01"),
            'payment_method' => 'check',
        ]);

        $sm_usr_prf = App\UserProfile::create([
        'first_name' => 'JoAnne' ,
            'last_name' => 'Davis' ,
            'street_address' => '4561 Mt. Pleasant Rd.' ,
            'city' => 'Cohutta' ,
            'state' => 'Georgia' ,
            'zip' => '30710' ,
            'is_occ_member' => 1,
            'membership_id' => $membership->id,
            'user_id' => $sm_user->id ,
            'willing_to_work' => 'yes'
        ]);

        $sm_user = App\User::create([
            'email' => 'jmg@tnaqua.org',
            'password' =>  bcrypt('password'),
            'roles_id' => '3',
            'has_logged_in_once' => '0',
        ]);

        $membership = App\Membership::create([
            'membership_type_id' => 1,
            'start_date' => new DateTime("2016-05-01"),
            'end_date' =>   new DateTime("2017-05-01"),
            'payment_method' => 'check',
        ]);


        $sm_usr_prf = App\UserProfile::create([
        'first_name' => 'Julia' ,
            'last_name' => 'Gregory' ,
            'street_address' => '222 Parks Rd.' ,
            'city' => 'McDonald' ,
            'state' => 'Tennessee' ,
            'zip' => '37353' ,
            'is_occ_member' => 1,
            'membership_id' => $membership->id,
            'user_id' => $sm_user->id ,
            'willing_to_work' => 'yes'
        ]);

        $sm_user = App\User::create([
            'email' => 'msbrett@87gdesign.com',
            'password' =>  bcrypt('password'),
            'roles_id' => '3',
            'has_logged_in_once' => '0',
        ]);
        $membership = App\Membership::create([
            'membership_type_id' => 2,
            'start_date' => new DateTime("2016-05-01"),
            'end_date' =>   new DateTime("2017-05-01"),
            'payment_method' => 'check',
        ]);


        $sm_usr_prf = App\UserProfile::create([
        'first_name' => 'Mary & Anthony' , 
            'last_name' => 'Lugan' , 
            'street_address' => '466 Oak Street' ,
            'city' => 'Rossville' ,
            'state' => 'Georgia' ,
            'zip' => '30741' ,
            'is_occ_member' => 1,
            'membership_id' => $membership->id,
            'user_id' => $sm_user->id ,
            'willing_to_work' => 'yes'
        ]);

        $sm_user = App\User::create([
            'email' => 'stellarbt@charter.net',
            'password' =>  bcrypt('password'),
            'roles_id' => '3',
            'has_logged_in_once' => '0',
        ]);

        $membership = App\Membership::create([
            'membership_type_id' => 1,
            'start_date' => new DateTime("2016-05-01"),
            'end_date' =>   new DateTime("2017-05-01"),
            'payment_method' => 'check',
        ]);


        $sm_usr_prf = App\UserProfile::create([
        'first_name' => 'Linda' ,
            'last_name' => 'Maddox' ,
            'street_address' => '296 TJ Arnold Circle' ,
            'city' => 'Ringgold' ,
            'state' => 'Georgia' ,
            'zip' => '30736' ,
            'is_occ_member' => 1,
            'membership_id' => $membership->id,
            'user_id' => $sm_user->id ,
            'willing_to_work' => 'yes'
        ]);

        $sm_user = App\User::create([
            'email' => 'idreamofpinkcars@aol.com',
            'password' =>  bcrypt('password'),
            'roles_id' => '3',
            'has_logged_in_once' => '0',
        ]);

        $membership = App\Membership::create([
            'membership_type_id' => 1,
            'start_date' => new DateTime("2016-05-01"),
            'end_date' =>   new DateTime("2017-05-01"),
            'payment_method' => 'check',
        ]);


        $sm_usr_prf = App\UserProfile::create([
        'first_name' => 'Jamie' ,
            'last_name' => 'Morgan' ,
            'street_address' => '3813 Lamar Ave.' ,
            'city' => 'Chattanooga' ,
            'state' => 'Tennessee' ,
            'zip' => '37415' ,
            'is_occ_member' => 1,
            'membership_id' => $membership->id,
            'user_id' => $sm_user->id ,
            'willing_to_work' => 'yes'
        ]);

        $sm_user = App\User::create([
            'email' => 'geofay@bellsouth.net',
            'password' =>  bcrypt('password'),
            'roles_id' => '3',
            'has_logged_in_once' => '0',
        ]);

        $membership = App\Membership::create([
            'membership_type_id' => 2,
            'start_date' => new DateTime("2016-05-01"),
            'end_date' =>   new DateTime("2017-05-01"),
            'payment_method' => 'check',
        ]);


        $sm_usr_prf = App\UserProfile::create([
            'first_name' => 'Fay & George',
            'last_name' => 'Taylor',  
            'street_address' => '809 Fairmont Ave.' ,
            'city' => 'Signal Mountain', 
            'state' => 'Tennessee' ,
            'zip' => '37377' ,
            'is_occ_member' => 1,
            'membership_id' => $membership->id,
            'user_id' => $sm_user->id ,
            'willing_to_work' => 'yes'
        ]);

        $sm_user = App\User::create([
            'email' => 'mountainbirddogs@aol.com',
            'password' =>  bcrypt('password'),
            'roles_id' => '3',
            'has_logged_in_once' => '0',
        ]);

        $membership = App\Membership::create([
            'membership_type_id' => 1,
            'start_date' => new DateTime("2016-05-01"),
            'end_date' =>   new DateTime("2017-05-01"),
            'payment_method' => 'check',
        ]);


        $sm_usr_prf = App\UserProfile::create([
        'first_name' => 'Laurie' ,
            'last_name' => 'Thompson' ,
            'street_address' => '1046 Coca-Cola Rd.' ,
            'city' => 'Dunlap' ,
            'state' => 'Tennessee' ,
            'zip' => '37327' ,
            'is_occ_member' => 1,
            'membership_id' => $membership->id,
            'user_id' => $sm_user->id ,
            'willing_to_work' => 'yes'
        ]);

        $sm_user = App\User::create([
            'email' => 'dltuthill@epbfi.com',
            'password' =>  bcrypt('password'),
            'roles_id' => '3',
            'has_logged_in_once' => '0',
        ]);
        $membership = App\Membership::create([
            'membership_type_id' => 1,
            'start_date' => new DateTime("2016-05-01"),
            'end_date' =>   new DateTime("2017-05-01"),
            'payment_method' => 'check',
        ]);


        $sm_usr_prf = App\UserProfile::create([
        'first_name' => 'Debbie' ,
            'last_name' => 'Tuthill' ,
            'street_address' => '618 River Landing Dr.' ,
            'city' => 'Soddy Daisy' ,
            'state' => 'Tennessee' ,
            'zip' => '37379' ,
            'is_occ_member' => 1,
            'membership_id' => $membership->id,
            'user_id' => $sm_user->id ,
            'willing_to_work' => 'yes'
        ]);

        $sm_user = App\User::create([
            'email' => 'carolwetzel3@gmail.com',
            'password' =>  bcrypt('password'),
            'roles_id' => '3',
            'has_logged_in_once' => '0',
        ]);

        $membership = App\Membership::create([
            'membership_type_id' => 1,
            'start_date' => new DateTime("2016-05-01"),
            'end_date' =>   new DateTime("2017-05-01"),
            'payment_method' => 'check',
        ]);


        $sm_usr_prf = App\UserProfile::create([
        'first_name' => 'Carol' ,
            'last_name' => 'Wetzel' ,
            'street_address' => '2234 Hollywood Ln.' ,
            'city' => 'Signal Mountain' ,
            'state' => 'Tennessee' ,
            'zip' => '37377' ,
            'is_occ_member' => 1,
            'membership_id' => $membership->id,
            'user_id' => $sm_user->id ,
            'willing_to_work' => 'yes'
        ]);

        $sm_user = App\User::create([
            'email' => 'ktw@taylorworth.com',
            'password' =>  bcrypt('password'),
            'roles_id' => '3',
            'has_logged_in_once' => '0',
        ]);
        $membership = App\Membership::create([
            'membership_type_id' => 2,
            'start_date' => new DateTime("2016-05-01"),
            'end_date' =>   new DateTime("2017-05-01"),
            'payment_method' => 'check',
        ]);


        $sm_usr_prf = App\UserProfile::create([
        'first_name' => 'Katherine & Rick & Martha' ,
            'last_name' => 'Worth-Taylor' ,
            'street_address' => '813 Fairmont Ave' ,
            'city' => 'Signal Mountain' ,
            'state' => 'Tennessee' ,
            'zip' => '37377' ,
            'is_occ_member' => 1,
            'membership_id' => $membership->id,
            'user_id' => $sm_user->id ,
            'willing_to_work' => 'yes'
        ]);

    }
}
