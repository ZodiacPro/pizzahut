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

Auth::routes();

//------------------------ Button URL
Route::group(['middleware' => 'auth'], function () {
	Route::get('/', 'App\Http\Controllers\HomeController@index')->name('main');

	Route::get('/threshold', 'App\Http\Controllers\HomeController@threshold')->name('threshold');
	Route::post('/threshold', 'App\Http\Controllers\HomeController@threshold')->name('threshold');

	Route::get('/alarm', 'App\Http\Controllers\HomeController@alarm')->name('alarm');
	Route::post('/alarm', 'App\Http\Controllers\HomeController@alarm')->name('alarm');

	Route::get('/history', 'App\Http\Controllers\HomeController@history')->name('history');
	Route::post('/history', 'App\Http\Controllers\HomeController@history')->name('history');

	Route::post('/clear', 'App\Http\Controllers\HomeController@clearAlarm')->name('clearAlarm');
});
