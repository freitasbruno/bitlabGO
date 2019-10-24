<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Group as Group;
use App\Models\User as User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Group::class, function (Faker $faker) {
    return [
		'id_user' => $faker->numberBetween(1, 2),
		'id_parent' => $faker->numberBetween($min = 1, $max = 100),
        'name' => $faker->sentence(2, true),
        'description' => $faker->text($maxNbChars = 200),
    ];
});

$factory->state(Group::class, 'homeGroup', function (Faker $faker) {
	return [
		'id_parent' => 0,
		'id_user' => function () {
			return factory(User::class)->create()->id;
		},
	];
});
