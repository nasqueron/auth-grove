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
    protected $signature = 'account:dump';

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
        $attributes = User::getDefaultAttributes();
        $headers = array_map('\AuthGrove\User::localizeAttribute', $attributes);

        $users = User::all($attributes)->toArray();

        $this->table($headers, $users);

        return;
    }
}
