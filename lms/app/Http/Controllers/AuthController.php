<?php
namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Http\Request;
use App\Models\Client;
use Auth;

Class AuthController extends Controller
{
	public function getSignup(Session $session)
	{

		 return view('auth.signup',['session'=>$session]);
	}
	

	public function getSignin(Session $session)
	{
		//$view = view ('auth.signin',['session'=>$session]);
		//$session->clear();
	    return	view ('auth.signin',['session'=>$session]);
	}

	
	public function postSignin(Request $request, Session $session)
	{
		$this->validate($request, [
			'email' => 'required',
			'password' => 'required',
		]);

		// $credentials = [
  //           'email' => $request->input('email'),
  //           'password' => $request->input('password'),
  //           'confirmed' => 1,
  //       ];
// HERE ======================================================================
        /*if ( ! Auth::attempt($credentials))
        {
            // return Redirect::back()
            //     ->withInput()
            //     ->withErrors([
            //         'credentials' => 'We were unable to sign you in.'
            //     ]);
            var_dump('ERROR');
            \Flash::message('Welcome back!');
            exit();
        }*/
        $confirmed = Client::whereEmail($request->input('email'))->first();
        if (!$confirmed->confirmed ==1){
        	$session->set('info' , 'Could not sign in Please check you inbox for confirmation First!!'); 
			return redirect()->route('auth.signin');
        }

		if (!\Auth::attempt($request->only(['email','password']),$request->has('remember'))) {
			$session->set('info' , 'Could not sign in Invalid Details'); 
			return redirect()->route('auth.signin');
		}
//============================================================================
		//Setting Sessions
		$session->set('email',$request->email);
		$session->set('password',$request->password);

		$session->set('info' , 'You are Signed in');
		//return redirect()->route('dashbord');
		return view('dashbord',['session'=>$session]);
	}


		public function postSignup(Request $request,Session $session)
	{
		$this->validate($request, [
			'email' => 'required|unique:clients|email',
			'username' => 'required|max:30',
			'password' => 'required|min:6',
		]);
		
		$confirmation_code = str_random(30);

		$user = $request->input('email');
		Client::create([
			'email'=> $request->input('email'),
			'username'=>$request->input('username'),
			'password'=>$request->input('password'),
			'confirmation_code'=>$confirmation_code,
		]);


		\Mail::raw("For confirmation of your account kindly run the given url in your web browser:

			http://localhost:8000/confirmation/".$confirmation_code."

			Best Regards
			Happy Coding!!", function ($message) use ($user){
            $message->to($user, 'Beloved User')
        		    ->subject('LaravelGMail App!');
        });

		$session->set('info' , 'Your Account has been created, check you inbox for confirmation First and then signin !!');
		return view('auth.signin',['session'=>$session]);
	}

	public function confirm($confirmation_code, Session $session)
	{
		if (! $confirmation_code) {
			throw new InvalidConfirmationCodeException;
		}

		$user = Client::whereConfirmationCode($confirmation_code)->first();
		if ( ! $user)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();

        //$session = array('info' => 'Done Confirmation');
        $session->set('info' , 'Done Confirmation');
		return view('auth.signin',['session'=>$session]);
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