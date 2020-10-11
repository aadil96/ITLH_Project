<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
	$filepath = storage_path('app/public/avatar');

	return [
//	    'batch_id' => App\Batch::class,
		'name' => $faker->name,
		'email' => $faker->email,
		'phone' => null,
		// 'profile_image_url' => $faker->image($filepath, 200, 200, null, false),
		// 'cv_url' => $faker->image($filepath, 200, 200, null, false),
		'competencies' => $faker->words(3, true),
		'password' => bcrypt('password'),
	];
});
