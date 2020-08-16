<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Proposal::class, function (Faker $faker) {
    return [
        'assignment_id' => 1,
        'user_id' => 1,
        'cover_letter' => $faker->paragraph(2),
        'status' => 'Pending Approval',
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
