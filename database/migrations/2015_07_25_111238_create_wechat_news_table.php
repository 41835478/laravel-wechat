<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatNewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wechat_news', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('wechat_id');
            $table->string('title');
            $table->string('author');
            $table->string('pic_url');
            $table->string('description');
            $table->string('news_url');
            $table->text('body');
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
		Schema::drop('wechat_news');
	}

}
