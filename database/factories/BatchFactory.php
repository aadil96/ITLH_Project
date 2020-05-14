<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Batch;
use Faker\Generator as Faker;

$factory->define(Batch::class, function (Faker $faker) {
    $months = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
    ];

    for ($x = 0; $x <= sizeof($months); $x++) {
        return dd($months[$x]);
    }

    // return [
    //     'name' => 
    // ];
});
