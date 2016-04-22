<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderUpKeep extends Model
{
    protected $table = 't_orderupkeep';
    protected $primaryKey='ou_id';
    protected $guarded = array();
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\OldUser','ou_us_id','us_id');
    }

    public function station()
    {
        return $this->hasOne('App\Station','id','ou_st_id');
    }

}
