<?php

namespace AuthGrove\Internationalization;

class UserAttribute extends LocalizableMessage {

    public function __construct ($attribute) {
        $this->prefix = "panel.user-attributes.";
        parent::__construct($attribute);
    }

}
