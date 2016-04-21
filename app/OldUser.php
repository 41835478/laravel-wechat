<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OldUser extends Model
{
    protected $table = 't_users';
    protected $primaryKey='us_id';
    protected $guarded = array();
    public $timestamps = false;
}
