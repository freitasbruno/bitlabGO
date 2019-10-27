<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Group;
use App\Models\Items\ItemCash;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(ItemCash::class, function (Faker $faker) {
    return [
		'id_parent' => 0,
		'id_account' => 0,
		'id_user' => 0,
		'name' => $faker->sentence(3, true),
		'description' => $faker->text($maxNbChars = 200),
		'type' => Arr::random(['expense', 'income']),
		'amount' => $faker->randomFloat(2, 50, 3000),
		'currency' => 'EUR',
    ];
});

$factory->state(ItemCash::class, 'smallExpenses', function (Faker $faker) {
	return [
		'amount' => $faker->randomFloat(2, 1, 50)
	];
});