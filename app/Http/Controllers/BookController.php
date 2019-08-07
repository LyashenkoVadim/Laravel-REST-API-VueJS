<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use Symfony\Component\HttpFoundation\Response;

use App\Services\ApiService;

class BookController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('');
    }

    public function index(Request $request)
    {
        if($request->per_page){
            $per_page = (int)$request->per_page;
        }
        else{
            $per_page = 5;
        }

        if($request->sort_by){
            $books = Book::where($request->except('per_page', 'sort_by'))->orderBy($request->sort_by)->paginate($per_page);
        }
        else{
            $books = Book::where($request->except('per_page', 'sort_by'))->paginate($per_page);
        }

        return BookResource::collection($books);

        // $per_page = ApiService::PerPageHandler($request);
        // return ApiService::PaginationHandler($per_page, 4, $class=Book::class, $class=BookResource::class);
    }

    public function store(BookRequest $request)
    {
        $book = new Book();

        $book->book_name = $request->input('book_name');
        $book->book_num_pages = $request->input('book_num_pages');
        $book->library_id = $request->input('library_id');

        if($book->save()){
            return response(null, Response::HTTP_CREATED);
        }
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return new BookResource($book);
    }

    public function update(BookRequest $request, Book $book)
    {
        $book->update($request->all());
        return new BookResource($book);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
