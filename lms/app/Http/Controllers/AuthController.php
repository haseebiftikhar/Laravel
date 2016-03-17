<?php
namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Http\Request;
use App\Models\Client;
use Auth;

Class AuthController extends Controller
{
	public function getSignup()
	{

		 return view('auth.signup');
	}
	
	public function postSignup(Request $request,Session $session)
	{
		$this->validate($request, [
			'email' => 'required|unique:users|email',
			'username' => 'required|max:30',
			'password' => 'required|min:6',
		]);
		
		Client::create([
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
		$session->clear();
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

		//Setting Sessions
		$session->set('email',$request->email);
		$session->set('password',$request->password);

		$session->set('info' , 'You are Signed in');
		//return redirect()->route('dashbord');
		return view('dashbord',['session'=>$session]);
	}

	public function dashbord( Session $session)
	{
		if ($session->has('email')) {
			if ($session->has('password')) {
				return view('dashbord', ['session'=>$session]);
			}
		}

		return redirect()->route('auth.signin');
	}

	public function postSignout(Session $session)
	{
		$session->clear();
		Auth::logout();
		return redirect()->route('home');
	}
}