<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarImages extends Model
{
    protected $table = 't_carimgs';
    //protected $primaryKey='id';
    protected $guarded = array();
    public $timestamps = false;
}
