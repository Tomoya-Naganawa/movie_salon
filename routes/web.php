<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/login/{social}', 'Auth\LoginController@socialLogin')->where('social', 'facebook|google');
Route::get('/login/{social}/callback', 'Auth\LoginController@handleProviderCallback')->where('social', 'facebook|google');
Route::get('/search', 'TmdbController@search');
Route::get('/search/{tmdb_movie_id}', 'TmdbController@show');

Route::get('/movies/{tmdb_movie_id}/store', 'MoviesController@store');
Route::get('/movies/{movie}', 'MoviesController@show');

Route::get('/reviews/{movie_id}/create', 'ReviewsController@create');
Route::resource('reviews', 'ReviewsController', ['only' => ['show', 'store', 'edit', 'update', 'destroy']]);

Route::resource('comments', 'CommentsController', ['only' => ['store', 'destroy']]);

Route::resource('favorites', 'FavoritesController', ['only' => ['store', 'destroy']]);

Route::get('/home', 'HomeController@index')->name('home');
