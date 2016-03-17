<?php
use Symfony\Component\HttpFoundation\Session\Session;

Route::get('/guzzle1', [
	'uses' => 'GuzzleController@get_git',
	]);

Route::get('/abc', [
	'uses' => 'ChartController@getChart',
	]);

Route::get('/weather', [
	'uses' => 'WeatherController@getWeather',
	]);

Route::get('/weatherForecast/{city}', [
	'uses' => 'WeatherController@weatherForecast',
	]);

Route::get('/displayForecast/{city}', [
	'uses' => 'WeatherChart@getWeather',
	]);

/*Route::get('/tweet', function ()  weatherForecast
{
	$client = new GuzzleHttp\Client([
        'base_uri' => 'https://api.twitter.com/1.1']);

	$auth = new \GuzzleHttp\Plugin\Oauth\OauthPlugin([
		'consumer_key' => 'din1tjknDIStAlCXM38W2yo2W',
		'consumer_secret' => 'yEuJXJKriZDg7Wj32FhtuLPeOmNUIDZRiPYbam5dupVXuEJKaI',
		'token' => '710110399358754816-7XEWnQo2LjKtGcc8FuHULhBLfJVoxxE',
		'token_secret' => 'wiRfRvIJV7ktTHe7PVlHjKV3O7e2iOhv2NxYZnsTSPnm7'
	]);
	$client->addSubscriber($auth);

    $res = $client->get('/search/tweets.json?q=laracasts');
    echo $res->getBody();
});
*/
/**
 * Guzzle Demo
 */
Route::get('/guzzle', function () {
    $client = new GuzzleHttp\Client();
    $response = $client->get('https://api.github.com/users/haseebiftikhar');
    return $response->getBody();
});

Route::get('users/{username}', function($username)
{
    $client = new GuzzleHttp\Client([
        'base_uri' => 'https://api.github.com/']);

    $res = $client->get("users/$username");

    //echo $res->getStatusCode();
    var_dump($res->getStatusCode());

    echo $res->getBody();
});

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

