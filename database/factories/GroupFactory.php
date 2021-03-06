<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Group as Group;
use App\Models\User as User;
use Faker\Generator as Faker;

$factory->define(Group::class, function (Faker $faker) {
    return [
		'id_parent' => 0,
		'id_user' => 0,
        'name' => $faker->sentence(2, true),
        'description' => $faker->text($maxNbChars = 200),
    ];
});

$factory->state(Group::class, 'homeGroup', function () {
	return [
		'id_parent' => 0,
		'id_user' => function () {
			return factory(User::class)->create()->id;
		},
	];
});
