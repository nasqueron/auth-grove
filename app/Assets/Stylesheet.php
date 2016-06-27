<?php

namespace AuthGrove\Assets;

class Stylesheet {
    ///
    /// CSS
    ///

    static private function printHeaders () {
        header("Content-type: text/css");
        header("X-Content-Type-Options: nosniff");
    }

    static public function compileLess ($file) {
        return `plessc $file`;
    }

    static public function printLess ($name) {
        $file = Assets::getAssetFilename('less', $name);

        if (file_exists($file)) {
            static::printHeaders();
            echo static::compileLess($file);
        } else {
            static::print404();
        }
    }

    ///
    /// 404
    ///

    static private function print404Headers () {
        header("HTTP/1.0 404 Not Found");
    }

    static private function print404 () {
        static::print404Headers();
        echo "/* 404 - Stylesheet not found. */";
    }

    ///
    /// Routes
    ///

    static public function handleRequest () {
        $name = $_GET['name'];

        if (!Assets::isValidAssetName($name)) {
            throw new \RuntimeException("Invalid resource name: $name");
        }

        switch ($_GET['resource']) {
            case 'less':
                static::printLess($name);
                break;

            default;
                throw new \RuntimeException("esource not found.");
        }
    }
}
