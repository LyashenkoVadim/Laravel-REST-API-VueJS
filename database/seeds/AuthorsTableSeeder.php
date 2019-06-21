<?php

use Illuminate\Database\Seeder;
use App\Author;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::create([
            'author_name' => 'Автор 1'
        ]);

        Author::create([
            'author_name' => 'Автор 2'
        ]);

        Author::create([
            'author_name' => 'Автор 3'
        ]);

        Author::create([
            'author_name' => 'Автор 4'
        ]);
    }
}
