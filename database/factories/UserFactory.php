<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$Uff4QGA0Mqz9vtI0I.gKE.bVrH5ChzwOifIhh5te04ZwBO7Ds69LC',
        'remember_token' => Str::random(10),
    ];
});