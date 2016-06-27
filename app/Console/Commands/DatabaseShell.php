<?php

namespace AuthGrove\Console\Commands;

use Illuminate\Console\Command;
use Config;

class DatabaseShell extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:shell';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Launch an interactive shell for your database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Executes the console command.
     */
    public function handle() {
        $this->runInteractiveShell();
    }

    /**
     * Runs an interactive database shell.
     *
     * The command to run depends of the engine set in configuration.
     */
    protected function runInteractiveShell () {
        $engine = Config::get('database.default');
        $command = $this->getCommand($engine);
        $env = $this->getEnvironment($engine);
        $this->runCommand($command, $env);
    }

    ///
    /// Helper methods to build commands
    ///

    /**
     * Gets the command to run an interactive shell for the specified db engine.
     *
     * @param string $engine The database engine to get the command for
     * @return string The command to run
     * @throws LogicException when not implemented for the selected engine
     */
    protected function getCommand ($engine) {
        $method = 'getCommandFor' . ucfirst($engine);
        if (method_exists($this, $method)) {
            return call_user_func([$this, $method]);
        }

        throw new \LogicException("No interactive shell command available for $engine engine.");
    }

    /**
     * Gets environment to run the command for the specified engine.
     *
     * @param string $engine The database engine
     *
     * @return array|null
     */
    private function getEnvironment ($engine) {
        $method = 'getEnvironmentFor' . ucfirst($engine);
        if (method_exists($this, $method)) {
            return call_user_func([$this, $method]);
        }

        // If no custom environment is set, we're happy with the current one
        return null;
    }

    /**
     * Gets the shell escaped form for the specified database.connections option.
     *
     * @return string
     */
    private function getOption ($option) {
        $key = 'database.connections.' . $option;
        $parameter = Config::get($key);
        return escapeshellarg($parameter);
    }

    /**
     * Gets command to run for a MySQL command line tool.
     *
     * @return string
     */
    protected function getCommandForMysql () {
        return
            'mysql -h ' . $this->getOption('mysql.host')
            . ' -u ' . $this->getOption('mysql.username')
            . ' --password=' . $this->getOption('mysql.password')
            . ' --default-character-set=' . $this->getOption('mysql.charset')
            . ' ' . $this->getOption('mysql.database');
    }

    /**
     * Gets command to run for a PostgreSQL interactive terminal.
     *
     * @return string
     */
    protected function getCommandForPgsql () {
        return
            'psql -h ' . $this->getOption('pgsql.host')
            . ' -d ' . $this->getOption('pgsql.database')
            . ' -U ' . $this->getOption('pgsql.username');
    }

    /**
     * Gets command to run for a SQL server client.
     *
     * @return string
     */
    protected function getCommandForSqlsrv () {
            'Sqlcmd -S ' . $this->getOption('sqlsrv.host')
            . ' -U ' . $this->getOption('sqlsrv.username')
            . ' -P ' . $this->getOption('sqlsrv.password')
            . ' -d ' . $this->getOption('sqlsrv.database');
    }

    /**
     * Gets command to run for a SQLite command line interface.
     *
     * @return string
     */
    protected function getCommandForSqlite () {
        return 'sqlite3 ' .  $this->getOption('sqlite.database');
    }

    /**
     * Gets an array with the current environment variables.
     *
     * @return array
     */
    protected function getCurrentEnvironment() {
        return $_SERVER;
    }

    /**
     * Gets environment for a PostgreSQL interactive terminal.
     *
     * The psql terminal doesn't provide arguments for the password
     * or for the charset, but they can be provided in environment.
     *
     * @return array
     */
    protected function getEnvironmentForPgsql () {
        return [
            // To store the password in the environment is deprecated,
            // but no alternative solution is handy without hints on
            // the infrastructure given in configuration file.
            'PGPASSWORD' => Config::get('database.connections.pgsql.password'),
            'PGCLIENTENCODING' => Config::get('database.connections.pgsql.charset'),
        ] + $this->getCurrentEnvironment();
    }

    ///
    /// Helper method to run a process interactively
    ///

    /**
     * Runs a command interactively.
     *
     * @param string $command The command to run
     * @param array|null $env The environment to pass, or null if current environment should be kept intact.
     */
    protected function runCommand ($command, $env = null) {
        $spec = [STDIN, STDOUT, STDERR];
        $pipes = [];

        $proc = proc_open(
            $command,
            $spec,
            $pipes,
            null, // Current working directory is fine.
            $env
        );

        if (!is_resource($proc)) {
            throw new \Exception('Failed to execute a command');
        }

        proc_close($proc);
    }

}
