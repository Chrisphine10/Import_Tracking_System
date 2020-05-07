<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'fname' => $faker->word,
        'lname' => $faker->word,
        'email' => $faker->safeEmail,
        'role' => $faker->randomElement(['manager', 'user', 'admin']),
        'email_verified_at' => $faker->dateTime(),
        'password' => bcrypt('12345678'),
        'remember_token' => Str::random(10),
    ];
});
