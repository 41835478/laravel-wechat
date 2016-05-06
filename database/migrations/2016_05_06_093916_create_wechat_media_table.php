<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->default(null)->index();
            $table->string('content');
            $table->integer('wechat_id')->default(0)->index();
            $table->timestamps();
        });
        $this->initData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('wechat_media');
    }

    public function initData()
    {
        \App\WechatMedia::create([
            'type'     =>  'news',
            'content'  =>  '',
            'wechat_id'=> 1
        ]);
    }
}
