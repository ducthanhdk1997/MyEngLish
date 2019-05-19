<?php

use Faker\Generator as Faker;

$factory->define(\App\Note::class, function (Faker $faker) {
    return [
        //
        'title' =>$faker->title,
        'content' => $faker->paragraph,

    ];
});
$factory->state(\App\Note::class,'finish', function (Faker $faker) {
    return [
        //
        'state' => true,
        'plan' => $faker->dateTimeBetween('-2 month','-1 week')
    ];
});

$factory->state(\App\Note::class,'unfinish', function (Faker $faker) {
    return [
        //
        'state' => false,
        'plan' => $faker->dateTimeBetween('+1 week','+3 week')
    ];
});
