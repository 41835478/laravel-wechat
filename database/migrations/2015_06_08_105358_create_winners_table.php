<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWinnersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('winners', function(Blueprint $table)
		{
            $table->increments('id');
			$table->string('user_id');
            $table->integer('event_id');
            $table->integer('award_id');
            $table->string('cdkey');
            $table->boolean('is_cash')->default(0);
            $table->timestamp('win_at');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('winners');
	}

}
