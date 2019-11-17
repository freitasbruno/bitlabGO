<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
		'id_parent' => 0,
		'id_user' => 0,
		'name' => $faker->sentence(3, true),
		'description' => $faker->text($maxNbChars = 200)
    ];
});