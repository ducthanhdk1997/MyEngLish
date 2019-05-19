<?php

use Faker\Generator as Faker;

$factory->define(\App\Detail_Voucher::class, function (Faker $faker) {
    $voucher = [1 => 1, 2 => 2];
    return [
        //
        'voucher_id' => array_rand($voucher),
        'code'=> str_random(10),
        'state' => false
    ];
});

$factory->state(App\Detail_Voucher::class,'10', function (Faker $faker) {
    return [
        //
        'value' => 10
    ];
});
$factory->state(App\Detail_Voucher::class,'15', function (Faker $faker) {
    return [
        //
        'value' => 15
    ];
});
$factory->state(App\Detail_Voucher::class,'20', function (Faker $faker) {
    return [
        //
        'value' => 20
    ];
});
$factory->state(App\Detail_Voucher::class,'50', function (Faker $faker) {
    return [
        //
        'value' => 50
    ];
});
$factory->state(App\Detail_Voucher::class,'100', function (Faker $faker) {
    return [
        //
        'value' => 100
    ];
});
