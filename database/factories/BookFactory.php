<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'book_name' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'book_num_pages' => $faker->numberBetween($min = 10, $max = 1200),
        'library_id' => $faker->numberBetween($min = 1, $max = 50),
    ];
});
