<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Runs the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->call('UsersTableSeeder');
    }

}
