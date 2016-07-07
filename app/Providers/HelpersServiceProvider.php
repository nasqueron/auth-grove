<?php

namespace AuthGrove\Providers;

use Illuminate\Support\ServiceProvider;

class HelpersServiceProvider extends ServiceProvider {

    /**
     * Bootstraps the application services.
     *
     * @return void
     */
    public function boot() {
        //
    }

    /**
     * Registers the application services.
     *
     * @return void
     */
    public function register() {
        require_once app_path() . '/Helpers/Routing.php';
    }

}
