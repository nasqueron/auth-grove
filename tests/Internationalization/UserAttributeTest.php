<?php

namespace AuthGrove\Tests\Internationalization;

use AuthGrove\Internationalization\UserAttribute;
use AuthGrove\Tests\TestCase;

class UserAttributeTest extends TestCase {

    public function testMessage () {
        $attribute = new UserAttribute("id");
        $this->assertSame("User ID", $attribute->localize()->get());
    }

}
