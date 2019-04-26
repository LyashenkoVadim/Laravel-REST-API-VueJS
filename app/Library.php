<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
		protected $table = 'libraries';

		protected $fillable = [
														'id',
														'library_name',
														'address'
		];

		public function authors()
		{
			return $this->belongsToMany('App\Author', 'libraries_authors', 'libraries_id', 'authors_id')->withTimestamps();
		}

		public function books(){
			return $this->hasMany('App\Book', 'library_id','id');
		}
}
