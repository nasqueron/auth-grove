<?php namespace AuthGrove\Http\Controllers\Auth;

use AuthGrove\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Contracts\Auth\PasswordBroker;
use AuthGrove\Services\AuthenticatesAndRegistersUsers;
use AuthGrove\Services\ResetsPasswords;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;
	use ResetsPasswords;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @param  \Illuminate\Contracts\Auth\PasswordBroker  $passwords
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar, PasswordBroker $passwords)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;
		$this->passwords = $passwords;

		$this->middleware('guest', ['except' => 'getLogout']);
	}
}
