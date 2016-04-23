<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Integral extends Model
{
    protected $table = 't_integral';
    protected $primaryKey='i_id';
    protected $guarded = array();
    public $timestamps = false;
}
