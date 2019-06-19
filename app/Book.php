<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'id',
        'book_name',
        'book_num_pages',
        'library_id',
    ];

    public function authors()
    {
        return $this->belongsToMany('App\Author', 'authors_books', 'books_id', 'authors_id')->withTimestamps();
    }

    public function libraries(){
        return $this->belongsTo('App\Library', 'library_id', 'id');
    }
}
