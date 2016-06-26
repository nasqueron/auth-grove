<?php

namespace AuthGrove\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Support\Facades\Password;
use AuthGrove\User;
use AuthGrove\Console\Services\AccountHelpers;

class AccountReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'account:reset {user} {--subject=} {--format=human}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets a reset password link for an account.';

    /**
     * The user e-mail
     *
     * @var string
     */
	private $email;

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
     * Gets e-mail subject from command line option or default l10n
     *
     * @return string the e-mail subject
     */
    public function getEmailSubject () {
        $subject = $this->option('subject');
        if ($subject === null) {
            return trans('emails.reset-password-subject');
        }
        return $subject;
    }

    /**
     * Sends a reset passsword e-mail
     *
     * @return bool true if a mail has been sent, false if the user is invalid
     */
    public function sendResetMail () {
        //Information we need for this mail
        $subject = $this->getEmailSubject();
        $credentials = [
            'email' => $this->email
        ];

        //Tries to send the mail
        $response = Password::sendResetLink($credentials, function($m) use ($subject)
        {
            $m->subject($subject);
        });

        //Handles password broker response, returning true on success
        switch ($response) {
            case PasswordBroker::RESET_LINK_SENT:
                return true;

            case PasswordBroker::INVALID_USER:
                return false;

            default:
                throw new Exception("Unhandled password broker response: " . $response);
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Gets the information
        $user = AccountHelpers::findUser($this->argument('user'));
        if ($user === null) {
            $this->error("User not found.");
            return;
        }

        $this->email = $user->getInformation()['email'];

        //Operation
        $success = $this->sendResetMail();
        if (!$success) {
            $this->error("The user has been found, but the password broker considers this user is invalid.");
            exit;
        }

        //Regular output
        $format = $this->option('format');
        switch ($format) {
            case "human":
                $this->info("A reset link mail has been sent to $this->email.");
                break;

            case "json":
                echo json_encode([
                    "result" => "ok",
                    "email" => $this->email
                ]);
                echo PHP_EOL;
                break;

            default:
                $this->error("Unknown format: $format");
        }
    }
}
