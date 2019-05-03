<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library;
use App\Http\Resources\Library as LibraryResource;
use App\Http\Requests\LibraryRequest;

class LibraryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get libraries
        $libraries = Library::paginate(15);
        
        // Return collection of libraries as resource
        return LibraryResource::collection($libraries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LibraryRequest $request)
    {
        $library = new Library;

        $library->library_name = $request->input('library_name');
        $library->address = $request->input('address');

        if($library->save()){
          return new LibraryResource($library);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get library
        $library = Library::findOrFail($id);

        // Return single library as a resource
        return new LibraryResource($library);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $library = Library::findOrFail($id);

        $library->library_name = $request->input('library_name');
        $library->address = $request->input('address');

        if($library->save()){
          return new LibraryResource($library);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get library
        $library = Library::findOrFail($id);

        if($library->delete()){
          return new LibraryResource($library);
        }
    }
}
