<?php namespace AuthGrove\Http\Controllers;

class LoginDashboardController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Login dashboard Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders a dashsboard for users that are authenticated. It
	| allows them to know they're already authenticated and to get information
	| about their authentication data, methods and connections.
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home');
	}
}
