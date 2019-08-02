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

        // {
        //     "per_page": "2",
        //     "book_name": "Non at illo.",
        //     "book_num_pages": "540",
        //     "library_id": "30",
        //     "created_at": "2019-07-01 03:17:41",
        //     "updated_at": "2019-07-01 03:17:41"
        // }
        if(count($request->query())){

            if($request->per_page){

            }

            return count($request->query());
        }

        $books = Book::paginate(4);
        return BookResource::collection($books);
        // $books = Book
        //                 ::where('book_name', "Non at illo.")
        //                 ->where('book_num_pages', 540)
        //                 ->where('library_id', 35)
        //                 ->where('created_at', "2019-07-01 03:17:41")
        //                 ->where('updated_at', "2019-07-01 03:17:41")
        //                 ->get();

        // if($request->book_name){
        //     $books = Book::where('library_id', $request->book_name)->get();
        // }
        // if($request->library_id){
        //     $books = Book::where('library_id', $request->library_id)->get();
        // }
        // if($request->book_num_pages){
        //     $books = Book::where('book_num_pages', $request->book_num_pages)->get();
        // }
        return count($request->query());
        $per_page = ApiService::PerPageHandler($request);
        return ApiService::PaginationHandler($per_page, 4, $class=Book::class, $class=BookResource::class);
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
