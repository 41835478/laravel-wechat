<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_menus', function (Blueprint $table) {
            //
            $table->increments('id')->unsigned();  //自增
            $table->integer('wechat_id')->unsigned();  //公众号ID
            $table->string('name')->default(null)->index();     //菜单名称
            $table->string('type',20);  //菜单类型
            $table->string('key')->default(null);
            $table->integer('menu_id')->default(0)->index()->unsigned();  //
            $table->timestamps();       //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('wechat_menus');
    }
}
