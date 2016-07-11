<?php

namespace AuthGrove\Tests\Models;

use AuthGrove\Models\User;
use AuthGrove\Tests\TestCase;

/**
 * Test User model.
 */
class UsersTest extends TestCase {

    function testTryGetFromExternalSource () {
        $this->assertFalse(
            User::tryGetFromExternalSource('phantasialand', 'Fairy Tale Forest', $user)
        );
        $this->assertFalse(
            User::tryGetFromExternalSource(null, null, $user)
        );
        $this->assertFalse(
            User::tryGetFromExternalSource('', 0, $user)
        );
    }

}
