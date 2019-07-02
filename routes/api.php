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
        'uses' => 'RelationshipController@index',
        'as' => 'libraries.book',
    ]
);

// Books routes
Route::apiResource('/books', 'BookController');

// Authors routes
Route::apiResource('/authors', 'AuthorController');
