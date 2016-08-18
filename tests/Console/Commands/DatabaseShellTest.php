<?php

namespace AuthGrove\Tests\Console\Commands;

use AuthGrove\Tests\TestCase;

use Artisan;
use Config;

/**
 * Test authentication views with GET request and form title checks.
 *
 * A test failure means an auth view is broken.
 */
class DatabaseShellTest extends TestCase {

    /**
     * Runs the command
     */
    private function runCommand () {
        Artisan::call('db:shell', []);
    }

    /**
     * @expectedException LogicException
     */
    public function testLogicExceptionIsThrownWhenEngineIsUnknown () {
        $formerEngine = Config::get('database.default');

        Config::set('database.default', 'unknownsql');
        $this->runCommand();

        Config::set('database.default', $formerEngine);
    }

}
