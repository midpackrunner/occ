<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'email' => $faker->safeEmail,
        'password' => bcrypt('password'),
        'remember_token' => str_random(10),
        'roles_id' => App\Role::where('type', '=', 'general_user')->first()->id,
        'has_logged_in_once' => '0',
    ];
});

$factory->define(App\UserProfile::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'street_address' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'zip' => $faker->postcode,
        'is_occ_member' => rand(0,1),
        //todo add membership_id foreign key
    ];
});

$factory->define(App\Membership::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'street_address' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'zip' => $faker->postcode,
        'is_occ_member' => rand(0,1),
        //todo add membership_id foreign key
    ];
});

$factory->define(App\PhoneNumber::class, function (Faker\Generator $faker) {
    $rand_types = ['mobile', 'home', 'work'];
    return [
        'type' => $rand_types[mt_rand(0, count($rand_types) - 1)],
        'number' => $faker->phoneNumber,
    ];
});

