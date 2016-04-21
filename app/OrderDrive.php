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
        return $this->belongsTo('App\OldUser','ou_us_id','us_id');
    }
}
