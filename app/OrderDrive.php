<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDrive extends Model
{
    protected $table = 't_orderdrive';
    protected $primaryKey='od_id';
    protected $guarded = array();
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\OldUser','od_us_id','us_id');
    }

    public function shop()
    {
        return $this->hasOne('App\Shop','id','od_st_id');
    }

    public function series()
    {
        return $this->hasOne('App\Series','s_id','od_s_id');
    }

    public function carmodel()
    {
        return $this->hasOne('App\CarModel','id','od_ct_id');
    }
}
