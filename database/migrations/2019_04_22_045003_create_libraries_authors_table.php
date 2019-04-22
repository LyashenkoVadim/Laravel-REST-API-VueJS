<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibrariesAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libraries_authors', function (Blueprint $table) {
            $table->bigIncrements('id');
						$table->bigInteger('libraries_id')->unsigned()->nullable();
						$table->foreign('libraries_id')->references('id')
						->on('libraries')->onDelete('cascade');

						$table->bigInteger('authors_id')->unsigned()->nullable();
						$table->foreign('authors_id')->references('id')
						->on('authors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libraries_authors');
    }
}
