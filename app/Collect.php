<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collect extends Model
{
    protected $table = 't_collect';
    protected $primaryKey='c_id';
    protected $guarded = array();
    public $timestamps = false;
}
