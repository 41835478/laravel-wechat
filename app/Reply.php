<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model {

	//
    protected $guarded = array();

    public function text()
    {
        return $this->hasOne('App\ReplyText');
    }

    public function news()
    {
        return $this->hasOne('App\ReplyNews');
    }

}
