<?php

namespace AuthGrove\Tests;

/**
 * Test authentication views with GET request and form title checks.
 *
 * A test failure means an auth view is broken.
 */
class AuthViewsTest extends TestCase {

    /**
     * Tests the sign in view
     */
    public function testSignInView() {
        $this->visit('/')
             ->see('form-signin');
    }

    /**
     * Tests the register account view
     */
    public function testRegisterAccountView() {
        $this->visit('/auth/register')
             ->see('form-register');
    }

    /**
     * Tests the recover access view
     */
    public function testRecoverAccessView() {
        $this->visit('/auth/recover')
             ->see('form-recover');
    }

    /**
     * Tests the lack of reset password view without token
     */
    public function testResetPasswordViewWithoutToken() {
        $response = $this->call('GET', '/auth/reset');
        $this->assertEquals(404, $response->getStatusCode());
    }

    /**
     * Tests the reset password view
     */
    public function testResetPasswordView() {
        $this->visit('/auth/reset/foo')
             ->see('form-reset');
    }

}
