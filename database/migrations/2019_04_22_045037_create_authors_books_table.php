<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorsBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors_books', function (Blueprint $table) {
            $table->bigIncrements('id');

						$table->bigInteger('authors_id')->unsigned()->nullable();
						$table->foreign('authors_id')->references('id')
						->on('authors')->onDelete('cascade');

						$table->bigInteger('books_id')->unsigned()->nullable();
						$table->foreign('books_id')->references('id')
						->on('books')->onDelete('cascade');

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
        Schema::dropIfExists('authors_books');
    }
}
