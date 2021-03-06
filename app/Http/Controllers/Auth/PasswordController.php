<?php

namespace AuthGrove\Http\Controllers\Auth;

use AuthGrove\Http\Controllers\Controller;
use AuthGrove\Services\ResetsPasswords;

use Illuminate\Foundation\Auth\RedirectsUsers;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use RedirectsUsers;
    use ResetsPasswords;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectPath = '/';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }
}
