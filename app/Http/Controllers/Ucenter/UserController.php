<?php namespace App\Http\Controllers\Ucenter;
use App\Http\Controllers\Controller;
use App\Wechat;

/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 6/23/15
 * Time: 11:08 AM
 */

class UserController extends BaseController{

    public function index()
    {
        $wechats = Wechat::paginate(15);
        return view('ucenter.index',compact('wechats'));
    }

}