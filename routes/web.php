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
    return view('music');
});


Route::get('/music', function () {
    return view('music');
})->middleware('IPcheck');


Route::get('/music/wingnut', function () {
    return view('albumview');
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
