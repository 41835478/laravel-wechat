<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WechatMenu extends Model
{
    //
    protected $guarded = array();

    public function subs()
    {
       return $this->hasMany('App\WechatMenu','menu_id','id');
    }
}
