<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Document::class, function (Faker $faker) {
    return [
        'proforma_invoice' => $faker->word,
        'idf' => $faker->word,
        'commercial_invoice' => $faker->word,
        'bill_of_landing' => $faker->word,
        'clearing_document' => $faker->word,
    ];
});
