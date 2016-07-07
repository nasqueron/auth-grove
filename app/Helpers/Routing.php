<?php

use AuthGrove\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| Blade helper global functions
|--------------------------------------------------------------------------
|
| This file register global helper functions to act as convenient aliases
| for methods normally requiring a fully qualified class name with namespaces
| to use in Blade template.
|
| e.g. {{ authurl('login') }} is a shorthand syntax for the longer construct
[ {{ url(AuthGrove\Http\Controllers\Auth\AuthController::getRoute('login')) }}
|
*/

/**
 * Gets the full URL of a specified auth route.
 *
 * @param string $action The authentication action (e.g. login) [facultative]
 * @return string The full URL (e.g. https://grove.domain.tld/auth/login)
 */
function authurl ($action = '') {
    $route = AuthController::getRoute($action);
    return url($route);
}
