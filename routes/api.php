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



Route::resource('events','EventsController');
Route::get('admin/events','EventsController@index')->name('admin.events');
Route::get('user/events','EventsController@allevents')->name('user.events');

Route::resource('admin','AdminController');
