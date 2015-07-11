<?php

namespace AuthGrove\Console\Commands;

use Illuminate\Console\Command;
use AuthGrove\User;
use AuthGrove\Console\Services\AccountHelpers as AccountHelpers;

class AccountInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'account:info {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get information about an account.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected function printInformationAttribute ($attribute, $value) {
        $line  = \Keruald\mb_str_pad(
            AccountHelpers::localizeUserAttribute($attribute),
            21
        );
        $line .= $value;
        $this->info($line);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = AccountHelpers::findUser($this->argument('user'));
        if ($user === null) {
            $this->error("User not found.");
            return;
        }

        foreach ($user->getInformation() as $attribute => $value) {
            $this->printInformationAttribute($attribute, $value);
        }
    }
}
