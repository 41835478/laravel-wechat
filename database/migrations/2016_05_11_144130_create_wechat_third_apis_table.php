<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatThirdApisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_third_apis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wechat_id')->default(1)->index();
            $table->string('api_url')->default(null);
            $table->string('token')->default(null);
            $table->string('keyword')->default(null)->index();//关键字
            $table->string('type')->default(null)->index(); //类型
            $table->string('remark')->default(null); //备注
            $table->tinyInteger('status')->default(1);
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
        Schema::drop('wechat_third_apis');
    }
}
