<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OldUser extends Model
{
    protected $table = 't_users';
    protected $primaryKey='us_id';
    protected $guarded = array();
    public $timestamps = false;

    //收藏
    public function collects()
    {
        return $this->hasMany('App\Collect','c_us_id','us_id');
    }

    //预约试驾
    public function appoints()
    {
        return $this->hasMany('App\OrderDrive','od_us_id','us_id');
    }

    //预约维修/保养

    public function orderUpKeep()
    {
        return $this->hasMany('App\OrderUpKeep','ou_us_id','us_id');
    }

    //油耗计算记录

    public function oilRecord()
    {
        return $this->hasMany('App\OilWear','o_us_id','us_id');
    }
}
