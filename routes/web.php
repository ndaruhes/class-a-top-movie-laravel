<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
});

Auth::routes();


Route::group(['namespace' => 'App\Http\Controllers'], function () {
    // AUTH ROUTES
    Route::get('/home', 'HomeController@index')->name('home');

    // ADMIN ROUTES
    Route::group(['middleware' => 'RoleAdmin'], function () {
        Route::get('/admin', 'HomeController@admin');

        // 1. Genre
        Route::get('/genre', 'GenreController@index');
        Route::post('/genre', 'GenreController@store')->name('storeGenre');
        Route::get('/genre/edit/{id}', 'GenreController@edit')->name('editGenre');
        Route::put('/genre/edit/{id}', 'GenreController@update')->name('updateGenre');
        Route::delete('/genre/delete/{id}', 'GenreController@destroy')->name('deleteGenre');

        // 2. Movie
        Route::get('/movie', 'MovieController@index');
        Route::post('/movie', 'MovieController@store')->name('storeMovie');
        Route::get('/movie/edit/{id}', 'MovieController@edit')->name('editMovie');
        Route::put('/movie/edit/{id}', 'MovieController@update')->name('updateMovie');
        Route::delete('/movie/delete/{id}', 'MovieController@destroy')->name('deleteMovie');
    });

    // MEMBER ROUTES
    Route::group(['middleware' => 'RoleMember'], function () {
        Route::get('/member', 'HomeController@member');
    });
});
