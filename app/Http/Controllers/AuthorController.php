<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Http\Resources\AuthorResource;
use App\Http\Requests\AuthorRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('');
    }

    public function index()
    {
        if($request->per_page){
            $per_page = (int)$request->per_page;
        }
        else{
            $per_page = 5;
        }

        if($request->sort_by){
            $authors = Author::where($request->except('per_page', 'sort_by'))->orderBy($request->sort_by)->paginate($per_page);
        }
        else{
            $authors = Author::where($request->except('per_page', 'sort_by'))->paginate($per_page);
        }

        return AuthorResource::collection($authors);
    }

    public function store(AuthorRequest $request)
    {
        $author = new Author();

        $author->author_name = $request->input('author_name');

        if($author->save()){
            return response(null, Response::HTTP_CREATED);
        }
    }

    public function show($id)
    {
        $author = Author::findOrFail($id);
        return new AuthorResource($author);
    }

    public function update(AuthorRequest $request, Author $author)
    {
        $author->update($request->all());
        return new AuthorResource($author);
    }

    public function destroy(Author $author)
    {
        $author->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
