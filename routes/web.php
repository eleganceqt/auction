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


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/auctions', 'AuctionsController@index');
Route::get('/fetch-auctions', 'AuctionsController@getAuctions');

Route::get('/auction/{auction}', 'AuctionsController@show');

Route::post('/place-bid', 'BidsController@place');
Route::post('/buyout-auction/{auction}', 'AuctionsController@buyoutAuction');

//Route::get('/auctions', 'AuctionsController@get');
