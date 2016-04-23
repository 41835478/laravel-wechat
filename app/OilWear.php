<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OilWear extends Model
{
    protected $table = 't_oilwear';
    protected $primaryKey='o_id';
    protected $guarded = array();
    public $timestamps = false;
}
