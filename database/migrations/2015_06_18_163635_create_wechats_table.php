<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wechats', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id');
            $table->string('public_name');
            $table->string('original_id');
            $table->string('wechat_account');
            $table->string('avatar');
            $table->string('wechat_type');
            $table->string('app_id');
            $table->string('secret');
            $table->string('encoding_aes_key');
            $table->string('wechat_token');
            $table->string('interface_url');
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
		Schema::drop('wechats');
	}

}
