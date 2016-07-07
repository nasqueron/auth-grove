<?php

namespace AuthGrove\Tests\Helpers;

use AuthGrove\Tests\TestCase;

class RoutingTest extends TestCase {

    function testGetRoute () {
        $this->assertStringEndsWith('/auth/login', authurl('login'));
        $this->assertStringEndsWith('/auth', authurl());
        $this->assertStringEndsWith('/auth', authurl(''));
        $this->assertStringEndsWith('/auth', authurl(null));
        $this->assertStringEndsWith('/auth', authurl(false));
        $this->assertStringEndsWith('/auth/0', authurl(0));
    }

}
