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
    return [
        'username' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'address'=> $faker->address,
        'avatar' => str_random(10).'png',
        'gender' => array_rand($gender),
        'phone' => $faker->phoneNumber,
        'facebook' =>'',
    ];
});

$factory->state(App\User::class,'students', function (Faker $faker) {
    return [
        'level' => 'Học viên',
        'role_id'=> 4,
    ];
});

$factory->state(App\User::class,'teachers', function (Faker $faker) {
    return [
        'level' => 'Thạc sĩ',
        'role_id'=> 3,
    ];
});
