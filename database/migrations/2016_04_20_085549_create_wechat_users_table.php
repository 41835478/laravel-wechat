<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wechat_id')->unsigned()->default(0)->index();
            $table->string('openid')->default('')->index();
            $table->string('nickname')->default('')->index();
            $table->tinyInteger('sex')->default(0);
            $table->string('language')->default('');
            $table->string('city')->default('');
            $table->string('province')->default('');
            $table->string('country')->default('');
            $table->string('headimgurl')->default('');
            $table->string('privilege')->default('');
            $table->string('unionid')->default('');
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
        Schema::drop('wechat_users');
    }
}
