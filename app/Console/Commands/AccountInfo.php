<?php

namespace AuthGrove\Console\Commands;

use AuthGrove\Console\Services\AccountHelpers as AccountHelpers;
use AuthGrove\Internationalization\UserAttribute;

use Illuminate\Console\Command;

class AccountInfo extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'account:info {user} {--format=human}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get information about an account';

    /**
     * The length of a padded localized attribute
     * @var int
     */
    const ATTRIBUTE_LEN = 21;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Prints a padded "attribute: value" line.
     *
     * @param string $attribute The attribute
     * @param string $value The value for this attribute
     */
    protected function printInformationAttribute ($attribute, $value) {
        $line = (new UserAttribute($attribute))
            ->localize()
            ->replaceSpacesByNonBreakableSpaces()
            ->pad(self::ATTRIBUTE_LEN)
            ->get();
        $line .= $value;
        $this->info($line);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $format = $this->option('format');

        $user = AccountHelpers::findUser($this->argument('user'));
        if ($user === null) {
            $this->error("User not found.");
            return;
        }

        $information = $user->getInformation();

        switch ($format) {
            case "human":
                foreach ($user->getInformation() as $attribute => $value) {
                    $this->printInformationAttribute($attribute, $value);
                }
                break;

            case "json":
                echo json_encode($information), "\n";
                break;

            default:
                $this->error("Unknown format: $format");
        }
    }

}
