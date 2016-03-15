<?php
use Symfony\Component\HttpFoundation\Session\Session;


Route::get('/alert', function (Session $session) {
	$session->set('info','Alert!');
	return redirect()->route('home');
	});

Route::get('/', function () {
    return redirect()->route('home');
	});

Route::get('/home', [
	'uses' => 'HomeController@index',
	'as' => 'home',
	]);

Route::get('/signup', [
	'uses' => '\App\Http\Controllers\AuthController@getSignup',
	'as' => 'auth.signup'
	]);

Route::post('/signup',[
	'uses' => '\App\Http\Controllers\AuthController@postSignup'
	]);

Route::get('/signin', [
	'uses' => '\App\Http\Controllers\AuthController@getSignin',
	'as' => 'auth.signin',
	]);

Route::post('/signin', [
	'uses' => '\App\Http\Controllers\AuthController@postSignin',
	]);

Route::get('/dashbord', [
	'uses' => '\App\Http\Controllers\AuthController@dashbord',
	'as' => 'dashbord',
	]);
Route::post('/dashbord', [
	'uses' => '\App\Http\Controllers\AuthController@dashbord',
	]);

Route::get('/signout', [
	'uses' => '\App\Http\Controllers\AuthController@postSignout',
	'as'=>'signout',
	]);

