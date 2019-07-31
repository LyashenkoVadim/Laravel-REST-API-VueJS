<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library;
use App\Http\Resources\LibraryResource;
use App\Http\Requests\LibraryRequest;
use Symfony\Component\HttpFoundation\Response;

class LibraryController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:api')->except('view');
    }

    public function index(Request $request)
    {
        if($request->per_page){
            if(ctype_digit($request->per_page)){
                $per_page = (int)$request->per_page;
                $libraries = Library::paginate($per_page);
            }
            else{
                return response('Error: per_page must be a positive number', Response::HTTP_BAD_REQUEST);
            }
        }
        else{
            $libraries = Library::paginate(4);
        }

        return LibraryResource::collection($libraries);
    }

    public function store(LibraryRequest $request)
    {
        $library = new Library();

        $library->library_name = $request->input('library_name');
        $library->address = $request->input('address');

        if($library->save()){
            return response(null, Response::HTTP_CREATED);
        }
    }

    public function show($id)
    {
        $library = Library::findOrFail($id);
        return new LibraryResource($library);
    }

    public function update(LibraryRequest $request, Library $library)
    {
        $library->update($request->all());
        return new LibraryResource($library);
    }

    public function destroy(Library $library)
    {
        $library->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function view()
    {
        return view('admin.libraries.index');
    }
}
