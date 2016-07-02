<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    ///
    /// Service providers
    ///

    /**
     * Asserts a service in the application container is from the expected type.
     *
     * @param $expectedType The type to check
     * @param $serviceName The service name to use as application container key
     */
    public function assertServiceInstanceOf ($expectedType, $serviceName) {
        $service = $this->app->make($serviceName);
        $this->assertInstanceOf($expectedType, $service);
    }

}
