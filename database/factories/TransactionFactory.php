<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\User;
use App\Document;
use App\Supplier;
$factory->define(App\Transaction::class, function (Faker $faker) {
    return [
        'proforma_invoice_number' => $faker->unique()->imageUrl(),
        'quantity' =>  $faker->numberBetween(1, 2000),
        'unit_price' => $faker->numberBetween(1, 2000),
        'total_price' => $faker->numberBetween(1, 2000),
        'description' => $faker->text,
        'payment_terms' => $faker->randomElement(['swift', 'RTGS', 'cheque']),
        'user_id' => factory(User::class),
        'date' => $faker->dateTimeBetween('-5 years', 'now'),
        'supplier_id' => factory(Supplier::class),
        'status' => $faker->randomElement(['ordered', 'in transit', 'received']),
        'document_id' => factory(Document::class),
    ];
});
