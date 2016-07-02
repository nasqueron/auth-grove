<?php

namespace AuthGrove\Http\Controllers\Auth;

use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;

use AuthGrove\Http\Controllers\Controller;
use AuthGrove\Services\Registrar;
use AuthGrove\Models\User;

use Config;
use Route;

class AuthController extends Controller implements RegistrarContract {

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

    use AuthenticatesAndRegistersUsers, ThrottlesLogins, Registrar;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * The field to use as username
     *
     * @var string
     */
    protected $username  = 'username';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    ///
    /// Routes
    ///

    /**
     * Gets the URL prefix for the authentication routes.
     *
     * @return string
     */
    protected static function getRoutePrefix () {
        return Config::get('auth.route');
    }

    /**
     * Gets a specific authentication route.
     *
     * @param $action The authentication action (e.g. login)
     * @return string The route URL (e.g. /auth/login)
     */
    public static function getRoute ($action) {
        $prefix = static::getRoutePrefix();

        if ((string)$action === '') {
            return $prefix;
        }

        return $prefix . '/' . $action;
    }

    /**
     * Registers auth routes.
     */
     public static function registerRoutes () {
        $auth = static::getRoutePrefix();

        // Login
        Route::get($auth, ['as' => 'auth.login', 'uses' => 'Auth\AuthController@showLoginForm']);
        Route::get($auth  . '/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@showLoginForm']);
        Route::post($auth . '/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@login']);

        // Logout
        Route::get($auth  . '/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@logout']);

        // Registration
        Route::get($auth  . '/register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@showRegistrationForm']);
        Route::post($auth . '/register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@register']);

        // Recover account
        Route::get($auth  . '/recover', ['as' => 'auth.password.reset', 'uses' => 'Auth\PasswordController@getRecover']);
        Route::post($auth . '/recover', ['as' => 'auth.password.reset', 'uses' => 'Auth\PasswordController@postRecover']);

        // Reset password (with a token received by mail)
        Route::get($auth  . '/reset/{token?}', ['as' => 'auth.password.reset', 'uses' => 'Auth\PasswordController@getReset']);
        Route::post($auth . '/reset', ['as' => 'auth.password.reset', 'uses' => 'Auth\PasswordController@reset']);
     }

}
