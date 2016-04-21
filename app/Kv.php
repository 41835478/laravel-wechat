<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kv extends Model
{
    //
    protected $table = 't_k_v';
    //protected $primaryKey='id';
    protected $guarded = array();
    public $timestamps = false;
}
