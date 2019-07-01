<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Library;
use Faker\Generator as Faker;

$factory->define(Library::class, function (Faker $faker) {
    return [
        'library_name' => 'Library ' . $faker->randomDigitNotNull,
        'address' => $faker->address,
    ];
});
