<?php

namespace AuthGrove\Assets;

class Assets {
    const ASSETS_DIRECTORY = 'resources/assets/';

    /**
     * Gets application root directory
     *
     * @return string
     */
    static public function getRootDirectory () {
        // We're in app/Assets, so we need to get twice to the parent directory.
        return dirname(dirname(__DIR__));
    }

    static public function getAssetsDirectory () {
        return static::getRootDirectory() . '/' . static::ASSETS_DIRECTORY;
    }

    static private function getAssetExtension ($type) {
        return $type;
    }

    static public function getAssetFilename ($type, $name) {
        return
            static::getAssetsDirectory()
            .
            "$type/$name."
            .
            static::getAssetExtension($type)
        ;
    }

    /**
     * Checks the resource has a valid format for sanity and to avoid
     * exploits trying to load an arbitrary resource URL.
     *
     * @param $name string The resource name
     * @return bool true if the resource name is valid; otherwise, false.
     */
    static public function isValidAssetName ($name) {
        return preg_match('/^[A-Za-z0-9\-_]*$/', $name);
    }
}
