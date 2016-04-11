<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class KeywordRule extends Model {

	//
    protected $guarded = array();

    public function keywords()
    {
        return $this->hasMany('App\Keyword');
    }

    public function replies()
    {
        return $this->hasManyThrough('App\ReplyText' ,'App\Reply');
    }

    public function reply()
    {
        return $this->hasMany('App\reply');
    }

}
