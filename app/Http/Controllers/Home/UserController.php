<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 16/4/23
 * Time: 上午10:46
 */

namespace App\Http\Controllers\Home;


use App\OldUser;

class UserController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    //个人中心首页
    public function user()
    {
        print_r($this->user['original']);
        //查询用户信息
        echo $this->user->openid;
        $user = OldUser::where('us_weixinid',$this->user->openid)->first();
        return view('home.user.index',compact('user'));
    }

    //车辆绑定
    public function carBind()
    {
        return view('home.user.carbind');
    }

    //个人信息
    public function userInfo()
    {
        return view('home.user.myinfo');
    }

    //违章查询
    public function queryViolation()
    {
        return view('home.user.illegal');
    }

    //我的收藏
    public function userCollection()
    {
        return view('home.user.collection');
    }

    //积分查询
    public function queryScore()
    {
        return view('home.user.point');
    }

    //预约
    public function appointment()
    {
        return view('home.user.appoint');
    }
    //预约记录
    public function appointRecord()
    {
        return view('home.user.order');
    }
    //油耗计算器
    public function oil()
    {
        return view('home.user.oilresult');
    }

    //维修保养记录
    public function maintenance()
    {
        return view('home.user.order');
    }

}