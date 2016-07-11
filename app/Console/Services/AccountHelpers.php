<?php

namespace AuthGrove\Console\Services;

use AuthGrove\Models\User;

class AccountHelpers {

    /**
     * Finds an user from user id, name or e-mail
     *
     * @param mixed $data User id, name or e-mail
     * @return User|null
     */
    public static function findUser ($data) {
        //By id
        if (is_numeric($data)) {
            return User::find($data);
        }

        //By other attributes
        $attributes = ['username', 'email'];
        foreach ($attributes as $attribute) {
            $user = User::findBy($attribute, $data);
            if ($user !== null) {
                return $user;
            }
        }

        return null;
    }

}
