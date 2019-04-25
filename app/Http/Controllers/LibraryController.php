<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library;
use App\Http\Resources\Library as LibraryResource;

class LibraryController extends Controller
{
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
				$library = $request->isMethod('put') ? Library::findOrFail($request->library_id) : new Library;

				$library->id = $request->input('library_id');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        //
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
