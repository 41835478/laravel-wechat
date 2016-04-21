<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 't_distributor';
    //protected $primaryKey='st_id';
    protected $guarded = array();
    public $timestamps = false;
}
