<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Items\Cash;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(Cash::class, function (Faker $faker) {
    return [
		'id_parent' => 0,
		'id_account' => 0,
		'id_user' => 0,
		'type' => Arr::random(['expense', 'income']),
		'amount' => $faker->randomFloat(2, 50, 3000),
		'currency' => 'EUR',
    ];
});

$factory->state(Cash::class, 'smallExpenses', function (Faker $faker) {
	return [
		'amount' => $faker->randomFloat(2, 1, 50)
	];
});