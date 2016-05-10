<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WechatPacket extends Model
{
    protected $guarded = array();

    public function wechat()
    {
        return $this->belongsTo('App\Wechat');
    }
}
