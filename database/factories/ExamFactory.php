<?php

use Faker\Generator as Faker;

$factory->define(\App\Exam::class, function (Faker $faker) {

    $rooms = [1=>0,2=>1,3=>2,4=>3,5=>4,6=>5,7=>6,8=>7,9=>8,10=>9];
    $courses = [1=>0,2=>1];
    return [
        //
        'title' => $faker->title,
        'course_id' => array_rand($courses),
        'shift_id' => 6,
        'classroom_id' => array_rand($rooms)
    ];
});

$factory->state(\App\Exam::class,'unfinish1', function (Faker $faker) {
    $date = \Carbon\Carbon::parse($faker->dateTimeBetween('+1 week','+2 month')->format('Y-m-d'));
    $deadline = \Carbon\Carbon::createFromTimestamp($date->getTimestamp())->addDays(6);
    return [
        //
        'start_date' => $date,
        'deadline' => $deadline,
        'state' => false
    ];
});



$factory->state(\App\Exam::class,'finish1', function (Faker $faker) {
    $date = $faker->dateTimeBetween('-2 month','-1 week');
    $deadline = \Carbon\Carbon::createFromTimestamp($date->getTimestamp())->addDays(6);
    return [
        'start_date' => $date,
        'deadline' => $deadline,
        'state' => true
    ];
});

