<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 15/3/27
 * Time: 下午2:34
 */

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{

    public $wechat_id;

    public $user;

    public function __construct()
    {
//        $this->middleware('wechat');
//
//        $this->wechat_id = session()->get('wechat_id');
//        $this->user = session()->get('wechat_user');
    }
} 