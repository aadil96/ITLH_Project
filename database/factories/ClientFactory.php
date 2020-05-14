<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {

    $filepath = public_path('storage/uploads');

    return [
        'company_name' => $faker->name,
        'profile_image' => $faker->image($filepath, 200, 200, null, false),
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt(123456789),
        'created_at' => now()
    ];
});
