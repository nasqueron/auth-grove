<?php

use AuthGrove\Models\User;

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
