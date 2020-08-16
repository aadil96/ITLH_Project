<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {

    $filepath = storage_path('app/public/avatar');

    return [
        'company_name' => $faker->name,
        'profile_image' => $faker->image($filepath, 200, 200, null, false),
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('password'),
        'created_at' => now()
    ];
});
