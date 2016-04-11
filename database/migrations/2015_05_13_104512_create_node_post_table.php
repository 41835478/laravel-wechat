<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodePostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('node_post', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';

            $table->integer('node_id')->unsigned()->index();
            $table->integer('post_id')->unsigned()->index();
            $table->string('post_type', 100);

            $table->primary(array('post_id', 'post_type'));

            $table->foreign('node_id')
                ->references('id')->on('nodes')
                ->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('node_post');
	}

}
