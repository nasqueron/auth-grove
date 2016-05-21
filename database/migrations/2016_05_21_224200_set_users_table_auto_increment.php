<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetUsersTableAutoIncrement extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // See https://secure.phabricator.com/book/phabflavor/article/things_you_should_do_now/#start-ids-at-a-gigantic
        $sql = "ALTER TABLE users AUTO_INCREMENT = 1000000000";
        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $maxId = (int)DB::table('users')->max('id');

        $sql = "ALTER TABLE users AUTO_INCREMENT = " . ++$maxId;
        DB::unprepared($sql);
    }

}
