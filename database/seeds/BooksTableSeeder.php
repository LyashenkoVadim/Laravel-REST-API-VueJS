<?php

use Illuminate\Database\Seeder;
use App\Book;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::create([
            'book_name' => 'Книга 1',
            'book_num_pages' => '10',
            'library_id' => '1'
        ]);

        Book::create([
            'book_name' => 'Книга 2',
            'book_num_pages' => '20',
            'library_id' => '2'
        ]);

        Book::create([
            'book_name' => 'Книга 3',
            'book_num_pages' => '30',
            'library_id' => '3'
        ]);


        DB::table('libraries_authors')->insert(
            ['libraries_id' => 1, 'authors_id' => 2]
        );

        DB::table('libraries_authors')->insert(
            ['libraries_id' => 2, 'authors_id' => 3]
        );

        DB::table('libraries_authors')->insert(
            ['libraries_id' => 3, 'authors_id' => 4]
        );

        DB::table('authors_books')->insert(
            ['authors_id' => 2, 'books_id' => 1]
        );

        DB::table('authors_books')->insert(
            ['authors_id' => 3, 'books_id' => 2]
        );

    }
}
