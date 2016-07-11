<?php

use AuthGrove\Internationalization\UserAttribute;

class UserAttributeTest extends TestCase {

    public function testMessage () {
        $attribute = new UserAttribute("id");
        $this->assertSame("User ID", $attribute->localize()->get());
    }

}
