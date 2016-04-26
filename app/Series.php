<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    //
    protected $table = 't_series';
    protected $primaryKey='s_id';
    protected $guarded = array();
    public $timestamps = false;

    public function carmodel()
    {
        return $this->hasMany('App\CarModel','s_id','s_id');
    }

}
