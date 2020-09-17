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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('profile', 'ProfileController@index')->name('profile');

Route::get('customize', function(){
    return view('customize.index');
})->middleware(['adminCheck'])->name('customize');

Route::get('customizeTrain', 'CustomizeController@index')->middleware('adminCheck')->name('customizeTrain');
Route::post('customizeTrain', 'CustomizeController@store')->middleware('adminCheck');
Route::post('customizePlaces', 'CustomizePlaces@store')->middleware('adminCheck')->name('customizePlaces');
Route::get('destroy', 'CustomizePlaces@destroy')->middleware('adminCheck');
Route::get('customizeStation', 'StationController@index')->middleware('adminCheck');
Route::post('customizeStation', 'StationController@store')->middleware('adminCheck');
Route::get('destroyStations', 'StationController@destroy')->middleware('adminCheck');

Route::get('customizeArrives', 'ArrivesController@index')->middleware('adminCheck');
Route::post('customizeArrives', 'ArrivesController@store')->middleware('adminCheck')->name('customizeArrives');

Route::get('getStations/{trace_name}', 'ArrivesController@get');
Route::get('test', 'ArrivesController@create');
Route::get('buyTicket', 'PlacesController@index')->name('buyTicket');
Route::post('buyTicket', 'PlacesController@store');
