<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model {

	//
    protected $guarded = array();

    public function keywordRule()
    {
        return $this->belongsTo('App\KeywordRule');
    }
}
