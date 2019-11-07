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

//Books
Route::post('books/create', 'BookController@store');
Route::get('books/find/{id}', 'BookController@show');
Route::post('books/update/{id}', 'BookController@update');
Route::get('books/delete/{id}', 'BookController@destroy');


Route::get('books', 'BookController@index');
Route::post('books/title', 'BookController@getBooksByTitle');
Route::post('books/category', 'BookController@getBooksByCategory');
Route::post('books/author', 'BookController@getBooksByAuthor');

//Author
Route::get('authors', 'AuthorController@index');
Route::post('authors/create', 'AuthorController@store');
Route::get('authors/find/{authorName}', 'AuthorController@show');
Route::post('authors/update/{id}', 'AuthorController@update');
Route::get('authors/delete/{id}', 'AuthorController@destroy');

//Category
Route::get('categories', 'CategoryController@index');
Route::post('categories/create', 'CategoryController@store');
Route::get('categories/find/{categoryName}', 'CategoryController@show');
Route::post('categories/update/{id}', 'CategoryController@update');
Route::get('categories/delete/{id}', 'CategoryController@destroy');
