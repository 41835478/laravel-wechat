<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 16/4/23
 * Time: 上午10:46
 */

namespace App\Http\Controllers\Home;


use App\OldUser;
use App\Series;

class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    //个人中心首页
    public function user()
    {
        //查询用户信息
        $user = OldUser::where('us_weixinid',$this->user['id'])->first();
        //$user = OldUser::where('us_weixinid',$this->user['id'])->first();
        return view('home.user.index',compact('user'));
    }

    //车辆绑定
    public function carBind()
    {
        $user = OldUser::where('us_weixinid',$this->user['id'])->first();
        return view('home.user.carbind',compact('user'));
    }

    //个人信息
    public function userInfo()
    {
        $user = OldUser::where('us_weixinid',$this->user['id'])->first();
        return view('home.user.myinfo',compact('user'));
    }

    //违章查询
    public function queryViolation()
    {
        $user = OldUser::where('us_weixinid',$this->user['id'])->first();
        return view('home.user.Illegal',compact('user'));
    }

    //我的收藏
    public function userCollection()
    {
        $user = OldUser::with('collects')->where('us_weixinid',$this->user['id'])->first();
        return view('home.user.collection',compact('user'));
    }

    //积分查询
    public function queryScore()
    {
        $user = OldUser::where('us_weixinid',$this->user['id'])->first();
        $ranking = OldUser::orderBy('us_integral','DESC')->take(10)->get();
        $records = '';//暂无
        return view('home.user.point',compact('user','ranking','records'));
    }

    //预约
    public function appointment()
    {
        $series = Series::orderBy('s_state')->all();
        $user = OldUser::where('us_weixinid',$this->user['id'])->first();
        return view('home.user.appoint',compact('user','series'));
    }
    //预约记录
    public function appointRecord()
    {
        $user = OldUser::with('appoints.shop')->where('us_weixinid',$this->user['id'])->first();
        return view('home.user.order',compact('user'));
    }
    //油耗计算器
    public function oil()
    {
        $user = OldUser::where('us_weixinid',$this->user['id'])->first();
        return view('home.user.oilresult',compact('user'));
    }

    //油耗计算记录
    public function oilResult()
    {
        $user = OldUser::with('oilRecords')->where('us_weixinid',$this->user['id'])->first();
        return view('home.user.history',compact('user'));
    }

    //维修保养记录
    public function maintenance()
    {
        $user = OldUser::with('orderUpKeep.station')->where('us_weixinid',$this->user['id'])->first();

        return view('home.user.orderupkeep',compact('user'));
    }

}