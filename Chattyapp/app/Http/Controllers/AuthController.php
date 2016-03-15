<?php
namespace Chatty\Http\Controllers;

use Illuminate\Http\Request;
use Chatty\Models\User;
use Symfony\Component\HttpFoundation\Session\Session;
use Auth;

class AuthController extends Controller
{
	public function getSignup()
	{

		 return view('auth.signup');
	}
	
	public function postSignup(Request $request,Session $session)
	{
		$this->validate($request, [
			'email' => 'required|unique:users|email',
			'username' => 'required|unique:users|alpha_dash|max:20',
			'password' => 'required|min:6',
		]);
		
		User::create([
			'email'=> $request->input('email'),
			'username'=>$request->input('username'),
			'password'=>bcrypt($request->input('password')),
		]);

		$session->set('info' , 'Your Account has been created');
		return redirect()->route('home');
	}

	public function getSignin(Session $session)
	{
		$view = view ('auth.signin',['session'=>$session]);
		
	    	return	$view;
	}

	public function postSignin(Request $request, Session $session)
	{
		$this->validate($request, [
			'email' => 'required',
			'password' => 'required',
		]);

		if (!Auth::attempt($request->only(['email','password']),$request->has('remember'))) {
			$session->set('info' , 'Could not sign in Invalid Details'); 
			return redirect()->route('auth.signin');
		}

		$session->set('info' , 'You are Signed in');
		return redirect()->route('home');
	}
}