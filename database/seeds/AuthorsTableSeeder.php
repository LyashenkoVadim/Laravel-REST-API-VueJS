<?php

use Illuminate\Database\Seeder;
use App\Author;
use App\Library;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authors = factory(Author::class, 4000)->create();

        $libraries = Library::all();

        Author::all()->each(function ($author) use ($libraries) {
            $author->libraries()->attach(
                $libraries->random(rand(1, 6))->pluck('id')->toArray()
            );
        });
    }
}
