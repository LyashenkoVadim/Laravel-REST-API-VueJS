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
        $libraries = factory(Library::class, 50)->create();
    }
}
