<?php

/**
 * Generate an .env file from an .env.example file
 * in a Cloud9 environment, for Laravel framework.
 */

class EnvironmentFile {
    ///
    /// Default values
    ///

    const DEFAULT_SOURCE = '.env.example';
    const DEFAULT_TARGET = '.env';

    ///
    /// Properties
    ///

    public $source;
    public $target;
    private $config;

    ///
    /// Constructors
    ///

    static public function load () {
        return new static(static::DEFAULT_SOURCE, static::DEFAULT_TARGET);
    }

    public function __construct ($source, $target) {
        $this->source = $source;
        $this->target = $target;
    }

    public function readDefaultConfiguration () {
        $lines = file($this->source);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === "" || $line[0] == '#') {
                //Blank lines and comment are ignored
                continue;
            }

            $var = explode('=', $line, 2);
            $this->config[$var[0]] = $var[1];
        }
        return $this;
    }

    private function getConfigurationLine ($key, $value) {
        return $key . '=' . $value;
    }

    public function getConfiguration () {
        $lines = [];
        foreach ($this->config as $key => $value) {
            $value = $this->amendVariable($key, $value);
            $lines[] = $this->getConfigurationLine($key, $value);
        }
        return implode("\n", $lines);
    }

    public function save () {
        $configToWrite = $this->getConfiguration();
        file_put_contents($this->target, $configToWrite);
    }

    public static function getRandomString ($len = 32) {
        $bytes = openssl_random_pseudo_bytes(++$len / 2);
        return substr(bin2hex($bytes), 0, $len);
    }

    public function amendVariable ($key, $value) {
        switch ($key) {
            case APP_KEY:
                if ($value == "SomeRandomString") {
                    return static::getRandomString();
                }
                break;

            case DB_HOST:
                return getenv("IP");

            case DB_DATABASE:
                return 'c9';

            case DB_USERNAME:
                return getenv("C9_USER");

            case DB_PASSWORD:
                return '';
        }

        return $value;
    }
}


if (!file_exists('.env.example')) {
    die("First, create an .env.example file with the default settings.\n");
}

echo EnvironmentFile::load()
    ->readDefaultConfiguration()
    ->getConfiguration();
