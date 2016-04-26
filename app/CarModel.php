<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    //
    protected $table = 't_carinfo';
    //protected $primaryKey='id';
    protected $guarded = array();
    public $timestamps = false;

    public function series()
    {
        return $this->belongsTo('App\Series','s_id','s_id');
    }

    public function carImages()
    {
        return $this->hasMany('App\CarImages','sortid');
    }
}
