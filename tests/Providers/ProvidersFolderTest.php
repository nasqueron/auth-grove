<?php

namespace AuthGrove\Tests\Providers;

use AuthGrove\Tests\TestCase;

use Config;
use File;

class ProvidersFolderTest extends TestCase {

    public function testOmittedFiles () {
        $providers = [];

        $namespace = $this->app->getInstance()->getNamespace() . 'Providers\\';
        $files = File::allFiles(app_path('Providers'));
        foreach ($files as $file) {
            $class = $namespace . $file->getBasename('.php');
            $providers[] = $class;
        }

        $configuredProviders = Config::get('app.providers');

        $this->assertArrayContainsArrayItems(
            $providers,
            $configuredProviders,
            "Provider missing in config/app.php (at providers key)"
        );

    }

}
