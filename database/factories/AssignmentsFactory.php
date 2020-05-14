<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Assignment;

$factory->define(Assignment::class, function (Faker $faker) {

    $filepath = public_path('storage/uploads');

    return [
        // 'client_id' => factory(App\Client::class),
        'title' => implode(' ', $faker->words(4)),
        'description' => $faker->paragraph(2),
        'specification_document_url' => $faker->image($filepath, 200, 200, null, false),
        'turn_around_time' => $faker->numberBetween(1, 100),
        'cost_low' => $faker->numberBetween(1, 100),
        'cost_high' => $faker->numberBetween(1, 100),
        'status' => 'Pending Approval',
        'tags' => implode(', ', $faker->words(3)),
    ];
});
