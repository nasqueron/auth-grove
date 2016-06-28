<?php namespace AuthGrove\Services;

use AuthGrove\Models\User;
use Validator;

/**
 * Trait offering an implementation of Illuminate\Contracts\Auth\Registrar
 */
trait Registrar {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'username' => 'required|max:255|unique:users',
			'fullname' => 'max:255',
			'email' => 'sometimes|required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:8',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		return User::create([
			'username' => $data['username'],
			'fullname' => $data['fullname'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
		]);
	}

}
