<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersExternalSourcesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users_external_sources', function(Blueprint $table) {
			$table->increments('id');
			$table->string('source_name');
			$table->string('source_user_id');
		    $table->integer('user_id')->unsigned();

			$table->timestamps();
			$table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('users_external_sources');
	}

}
