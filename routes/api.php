<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Libraries routes
Route::apiResource('/libraries', 'LibraryController');

// Route::group(['prefix'=>'libraries'], function(){
//     Route::apiResource('/{libraries}/books', 'LibraryBookController', [
//         'as' => 'libraries',
//     ]);
// });

Route::get(
    'libraries/{library}/books',
    [
        'uses' => 'RelationshipController@libraries_books',
        'as' => 'libraries.books',
    ]
);

Route::get(
    'libraries/{library}/authors',
    [
        'uses' => 'RelationshipController@libraries_authors',
        'as' => 'libraries.authors',
    ]
);

// Books routes
Route::apiResource('/books', 'BookController');

Route::get(
    'books/{book}/authors',
    [
        'uses' => 'RelationshipController@books_authors',
        'as' => 'books.authors',
    ]
);


// Authors routes
Route::apiResource('/authors', 'AuthorController');

Route::get(
    'authors/{author}/libraries',
    [
        'uses' => 'RelationshipController@authors_libraries',
        'as' => 'authors.libraries',
    ]
);

Route::get(
    'authors/{author}/books',
    [
        'uses' => 'RelationshipController@authors_books',
        'as' => 'authors.books',
    ]
);
