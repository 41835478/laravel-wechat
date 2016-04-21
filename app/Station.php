<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $table = 't_servingstation';
    //protected $primaryKey='st_id';
    protected $guarded = array();
    public $timestamps = false;
}
