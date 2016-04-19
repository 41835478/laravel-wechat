<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keywords', function (Blueprint $table) {
            $table->foreign('keyword_rule_id')
                ->references('id')->on('keyword_rules')
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
        Schema::table('keywords', function (Blueprint $table) {
            $table->dropForeign('keywords_keyword_rule_id_foreign');
        });
    }
}
