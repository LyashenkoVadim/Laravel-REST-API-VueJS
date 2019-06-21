<?php

use Illuminate\Database\Seeder;
use App\Library;

class LibrariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Library::create([
            'library_name' => 'Библиотека 1',
            'address' => 'Адрес Библиотеки 1'
        ]);

        Library::create([
            'library_name' => 'Библиотека 2',
            'address' => 'Адрес Библиотеки 2'
        ]);

        Library::create([
            'library_name' => 'Библиотека 3',
            'address' => 'Адрес Библиотеки 3'
        ]);
    }
}
