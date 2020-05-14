<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {

    $filepath = public_path('storage/uploads');

    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'profile_image_url' => $faker->image($filepath, 200, 200, null, false),
        'cv_url' => $faker->image($filepath, 200, 200, null, false),
        'competencies' => $faker->words(3),
        'password' => bcrypt(123456789)
    ];
});
