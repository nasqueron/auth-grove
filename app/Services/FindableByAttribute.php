<?php namespace AuthGrove\Services;

trait FindableByAttribute {
    /**
     * Finds an object by the specified attribute and value
     *
     * @param string $attribute The attribute to find
     * @param string $value The value the object should have for the specified attribute to match
     * @return Model|null If the object has been found, an instance of the class. Otherwise, null
     * 
     * e.g. User::findBy('username', 'quux')
     *
     * If the attribute isn't unique, this method will return the first object found.
     */
    static function findBy ($attribute, $value) {
        $method = 'static::where' . ucfirst($attribute);
        $object = call_user_func($method, $value)
            ->first(['*']);
        return $object;
    }
}
