<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_staffs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kf_account');//客服账号
            $table->string('kf_headimgurl');  //头像地址
            $table->integer('kf_id');       //客服id
            $table->string('kf_nick');  //昵称
            $table->string('kf_wx');  //微信号
            $table->string('invite_wx');  //邀请账号
            $table->integer('invite_expire_time');  //邀请过期时间
            $table->string('invite_status');    //邀请状态
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
        Schema::drop('wechat_staffs');
    }
}
