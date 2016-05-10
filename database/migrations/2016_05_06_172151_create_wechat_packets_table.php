<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatPacketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_packets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wechat_id')->default(1)->index();        //公众号id
            $table->string('mch_billno',28)->default(null)->index();  //商户订单号
            $table->string('mch_id',32)->default(null)->index();      //商户号,无需填写
            $table->string('send_name',32)->default(null)->index();   //商户名称
            $table->string('re_openid',32)->default(null);            //种子用户openid
            $table->integer('total_amount')->default(0);              //红包发放总金额
            $table->integer('total_num')->default(0);                 //红包发放人数,裂变红包不小于3,普通红包为1
            $table->string('amt_type')->default('ALL_RAND');          //红包金额设置方式
            $table->string('wishing',128)->default(null);             //红包祝福语
            $table->string('act_name',32)->default(null);             //活动名称
            $table->string('remark');                                 //备注信息
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
        Schema::drop('wechat_packets');
    }
}
