<?php

namespace AuthGrove\Console\Commands;

use Illuminate\Console\Command;
use AuthGrove\User as User;

class AccountDump extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'account:dump {--format=human}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dumps the accounts list.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $format = $this->option('format');

        $attributes = User::getDefaultAttributes();
        $users = User::all($attributes)->toArray();

        switch ($format) {
            case "human":
                $headers = array_map('\AuthGrove\User::localizeAttribute', $attributes);
                $this->table($headers, $users);
                break;

            case "json":
                echo json_encode($users);
                break;

            default:
                $this->error("Unknown format: $format");
        }
    }
}
