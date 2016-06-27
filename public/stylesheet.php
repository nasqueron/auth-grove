<?php

/*
|--------------------------------------------------------------------------
| Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels nice to relax.
|
*/

require __DIR__.'/../bootstrap/autoload.php';

/*
|--------------------------------------------------------------------------
| Run the micro application
|--------------------------------------------------------------------------
|
| We can now handle the incoming request through Assets and Stylesheet classes.
|
*/

AuthGrove\Assets\Stylesheet::handleRequest();
