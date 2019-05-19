<?php

use Faker\Generator as Faker;

$factory->define(\App\Class_Session::class, function (Faker $faker) {
    $rooms = [1=>0,2=>1,3=>2,4=>3,5=>4,6=>5,7=>6,8=>7,9=>8,10=>9];
    $class_id = [1=>0,2=>1];
    $shifts = [1=>0,2=>1,3=>2,4=>3,5=>4];
    return [


        //
        'title' => $faker->title,
        'class_id' => array_rand($class_id),
        'shift_id' => array_rand($shifts),
        'classroom_id' => array_rand($rooms)

    ];
});

$factory->state(\App\Class_Session::class,'unfinish1', function (Faker $faker) {
    $date = $faker->dateTimeBetween('+1 week','+2 month');
    return [
        //
        'start_date' => $date,
        'state' => false
    ];
});



$factory->state(\App\Class_Session::class,'finish1', function (Faker $faker) {
    $date = $faker->dateTimeBetween('-2 month','-1 week');
    return [
        'start_date' => $date,
        'state' => true
    ];
});
