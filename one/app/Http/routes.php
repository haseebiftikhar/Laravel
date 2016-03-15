<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/{id}', function ($id) {
//     return 'User ' .$id;
// });

// Route::group(['prefix' => 'admin','as' => 'Admin::'], function () {
//     Route::get('abc', ['as' => 'dashboard', 'uses' => 'DummyUsers@index']);
//     Route::get('def', ['as' => 'dashboard', 'uses' => 'DummyUsers@create']);
// });
// dd(route('Admin::abc'));

Route::get('/1', ['uses' => 'DummyUsers@index', 'as' => 'name']);
Route::get('/2','DummyUsers@create');
//dd(route('name'));
Route::get('add/{user_name}/{bill_number}/{bill_status}','RecordController@index');
Route::get('store/{user_name}/{bill_number}/{bill_status}','RecordController@store');
Route::get('update/{id}/{bill_status}','RecordController@update');
Route::get('show/{id}','RecordController@show');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
