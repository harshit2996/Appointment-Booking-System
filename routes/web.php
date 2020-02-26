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

Route::get('/t', function () {
    event(new \App\Events\SendMessage());
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['admin']], function(){
    Route::get('/admin', 'AdminController@construct')->name('admin');
    Route::get('/admin/events/{userid}', 'AdminController@events');
    Route::post('/admin/events/{userid}', 'EventsController@events');

});

Route::group(['middleware' => ['user']], function(){
    Route::get('/{name}',['uses'=> 'UserController@construct']);

});
Route::get('api/events', 'EventsController@construct');
Route::post('api/events','EventsController@store');


