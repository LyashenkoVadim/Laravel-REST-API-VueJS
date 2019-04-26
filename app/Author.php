<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
		protected $table = 'authors';

		protected $fillable = [
														'id',
														'author_name'
		];

		public function books()
		{
			return $this->belongsToMany('App\Book', 'authors_books', 'authors_id', 'books_id')->withTimestamps();
		}

		public function libraries()
		{
			return $this->belongsToMany('App\Library', 'libraries_authors', 'authors_id', 'libraries_id')->withTimestamps();
		}
}
