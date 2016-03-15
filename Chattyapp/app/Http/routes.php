<?php

/**
 * USE SESSION -SYMPONY
 */
use Symfony\Component\HttpFoundation\Session\Session;


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

 
Route::get('/', [
	'uses' => '\Chatty\Http\Controllers\HomeController@index',
	'as' => 'home',
	]);

Route::get('/alert', function (Session $session) {
	$session->set('info','You have signed up!');
	return redirect()->route('home');
	});

/**
 * Authentication
 */

Route::get('/signup', [
	'uses' => '\Chatty\Http\Controllers\AuthController@getSignup',
	'as' => 'auth.signup',
	]);

Route::post('/signup', [
	'uses' => '\Chatty\Http\Controllers\AuthController@postSignup',
	]);


Route::get('/signin', [
	'uses' => '\Chatty\Http\Controllers\AuthController@getSignin',
	'as' => 'auth.signin',
	]);

Route::post('/signin', [
	'uses' => '\Chatty\Http\Controllers\AuthController@postSignin',
	]);


