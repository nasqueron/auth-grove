<?php

namespace AuthGrove\Tests\Console\Commands;

use AuthGrove\Http\Controllers\Auth\AuthController;
use AuthGrove\Tests\TestCase;

/**
 * Test User model.
 */
class AuthControllerTest extends TestCase {

    function testGetRoute () {
        $this->assertSame('/auth/login', AuthController::getRoute('login'));
        $this->assertSame('/auth', AuthController::getRoute(''));
        $this->assertSame('/auth', AuthController::getRoute(null));
        $this->assertSame('/auth', AuthController::getRoute(false));
        $this->assertSame('/auth/0', AuthController::getRoute(0));
    }

}
