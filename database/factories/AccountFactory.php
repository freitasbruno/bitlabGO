<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Account as Account;
use App\Models\User as User;
use Faker\Generator as Faker;

$factory->define(Account::class, function (Faker $faker) {
    return [
		'id_parent' => 0,
		'id_user' => 0,
        'name' => $faker->sentence(2, true),
        'description' => $faker->text($maxNbChars = 200),
        'balance' => 0,
    ];
});
