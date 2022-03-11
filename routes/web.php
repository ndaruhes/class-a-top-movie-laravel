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
    });

    // MEMBER ROUTES
    Route::group(['middleware' => 'RoleMember'], function () {
        Route::get('/member', 'HomeController@member');
    });
});
