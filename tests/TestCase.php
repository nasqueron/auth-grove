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
    /// Custom assertions
    ///

    /**
     * Asserts each value of an array are included in another array.
     *
     * @param array|Traversable $needles The values to search
     * @param array|Traversable $haystack The array to check values exist
     * @param string $message The test message
     */
    public static function assertArrayContainsArrayItems ($needles, $haystack, $message) {
        self::assertThat(
            self::arrayContainsArrayItems($needles, $haystack),
            self::isTrue(),
            $message
        );
    }

    /**
     * Checks if each value of an array are included in another array.
     *
     * @param array|Traversable $needles The values to search
     * @param array|Traversable $haystack The array to check values exist
     * @return bool true if each $needles value is found in $haystack; otherwise, false
     */
    public static function arrayContainsArrayItems ($needles, $haystack) {
        foreach ($needles as $needle) {
            if (!in_array($needle, $haystack)) {
                return false;
            }
        }
        return true;
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
