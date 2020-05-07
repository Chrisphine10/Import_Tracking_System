<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Additional::class, function (Faker $faker) {
    return [
        'document_id' => factory(App\Document::class),
        'name' => $faker->name,
        'document' => $faker->word,
    ];
});
