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
Route::get('/search/{movie_id}', 'TmdbController@show');

Route::get('/home', 'HomeController@index')->name('home');
