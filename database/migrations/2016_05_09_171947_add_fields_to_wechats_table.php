<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToWechatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wechats', function (Blueprint $table) {
            $table->string('mch_id')->index()->after('wechat_token');
            $table->string('send_name')->index()->after('mch_id');
            $table->string('key',32)->default(null)->index()->after('mch_id');
            $table->string('cert_path')->after('key');
            $table->string('key_path')->after('cert_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wechats', function (Blueprint $table) {
            //
        });
    }
}
