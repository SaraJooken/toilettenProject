<?php

use Illuminate\Support\Facades\Auth;
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

/*Route::get('/', function () {
    return view('index');
});*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('index');
Route::post('/toiletten', 'ToilettenController@findNearToilet')->name('neartoilet');
Route::post('/toiletten/clean', 'ToilettenController@findCleanToilet')->name('cleantoilet');
Route::get('/review/create/{id}', 'ReviewController@create')->name('createReview');
Route::get('/review/show/{id}', 'ReviewController@show')->name('readReview');
Route::resource('review', 'ReviewController');
