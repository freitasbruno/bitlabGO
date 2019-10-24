<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Group;
use App\Models\Items\ItemCash;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

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

$factory->define(ItemCash::class, function (Faker $faker) {
    return [
		'id_parent' => $faker->numberBetween(1, 14),
		'name' => $faker->sentence(4, true),
		'description' => $faker->text($maxNbChars = 200),
		'type' => Arr::random(['expense', 'income']),
		'amount' => $faker->randomFloat(2, 50, 3000),
		'currency' => 'EUR',
		'id_user' => function (array $cash) {
            return Group::find($cash['id_parent'])->id_user;
        }
    ];
});

$factory->state(ItemCash::class, 'smallExpenses', function (Faker $faker) {
	return [
		'amount' => $faker->randomFloat(2, 1, 50)
	];
});