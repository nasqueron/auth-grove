<?php namespace AuthGrove\Http\Controllers;

use Illuminate\Http\Request;

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
    public function __construct() {
        $this->middleware('auth');
    }

	/**
	 * Show the application dashboard to the user.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function index(Request $request)
	{
		if (!$user = $request->user()) {
			throw new \LogicException("The login dashboard controller is called when there isn't any instance of an authenticated user.");
		}

		return view(
			'home',
			[
				'user' => $user->getInformation(),
			]
		);
	}
}
