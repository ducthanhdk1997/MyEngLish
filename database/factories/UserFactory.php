<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    $gender=[0=>0,1=>1];
    $roles = [1 => 0, 2 => 1, 3 => 2, 4=> 3];
    return [
        'username' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'avatar' => str_random(10).'png',
        'gender' => array_rand($gender),
        'phone' => $faker->phoneNumber,
        'role_id'=> array_rand($roles),
    ];
});
