<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoopImg extends Model
{
    //
    protected $table = 't_loopimg';
    protected $primaryKey='l_id';
    protected $guarded = array();
    public $timestamps = false;
}
