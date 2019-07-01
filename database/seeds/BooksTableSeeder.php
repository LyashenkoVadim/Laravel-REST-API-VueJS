<?php

use Illuminate\Database\Seeder;
use App\Book;
use App\Author;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = factory(Book::class, 5000)->create();

        $authors = Author::all();

        Book::all()->each(function ($book) use ($authors) {
            $book->authors()->attach(
                $authors->random(rand(1, 6))->pluck('id')->toArray()
            );
        });
    }
}
