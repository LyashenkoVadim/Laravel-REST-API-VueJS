<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Author;
use App\Library;
use App\Http\Resources\LibraryResource;
use App\Http\Resources\BookResource;
use App\Http\Resources\AuthorResource;

class RelationshipController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('');
    }

    // libraries/{library}/books
    public function libraries_books(Library $library)
    {
        $books = $library->books()->paginate(15);
        return BookResource::collection($books);
    }

    // libraries/{library}/authors
    public function libraries_authors(Library $library)
    {
        $authors = $library->authors()->paginate(15);
        return AuthorResource::collection($authors);
    }

    // books/{book}/authors
    public function books_authors(Book $book)
    {
        $authors = $book->authors()->paginate(15);
        return AuthorResource::collection($authors);
    }

    // authors/{author}/libraries
    public function authors_libraries(Author $author)
    {
        $libraries = $author->libraries()->paginate(15);
        return LibraryResource::collection($libraries);
    }

    // authors/{author}/books
    public function authors_books(Author $author)
    {
        $books = $author->books()->paginate(15);
        return BookResource::collection($books);
    }

}
