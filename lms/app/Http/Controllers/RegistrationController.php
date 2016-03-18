<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Http\Request;
use App\Models\Client;
use Auth;

Class RegistrationController extends Controller
{
	public function store(Request $request,Session $session)
	{
		/*$rules = [
            'username' => 'required|min:6|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ];

        $input = Input::only(
            'username',
            'email',
            'password',
            'password_confirmation'
        );*/

        $this->validate($request, [
			'email' => 'required|email|unique:clients',
			'username' => 'required|min:6|unique:clients',
			'password' => 'required|min:6',
		]);
		

       /* $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
        	$session->set('info' , 'Please enter valid email address.');
        	return redirect()->route('auth.signin');
        }
*/
        $confirmation_code = str_random(30);

        dd($confirmation_code);

        Client::create([
			'email'=> $request->input('email'),
			'username'=>$request->input('username'),
			'password'=>$request->input('password'),
			'confirmation_code'=>$confirmation_code,
		]);

		//Flash::message('Thanks for signing up! Please check your email.');

        $session->set('info' , 'Thanks for signing up! Please check your email.'); 
		return redirect()->route('home');

	}
}