<?php namespace AuthGrove\Providers;

use Illuminate\Support\ServiceProvider;

use AuthGrove\Http\Controllers\Auth\AuthController;

use Blade;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		// Blade templates can invoke AuthController::getRoute as authurl()
		Blade::directive('authurl', function ($expression) {
			preg_match("@\('(.*)'\)@", $expression, $matches); // ('foo') → foo
			$action = $matches[1];
			return url(AuthController::getRoute($action));
		});
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
	}

}
