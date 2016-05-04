<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 16/5/4
 * Time: 下午2:27
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class TestController extends Controller
{

    public function getTestAuth(Request $request)
    {

        if($request->input('openid')){
            dd($request->all());
        }else{
            $redirect = route(Route::currentRouteName());
            $redirect = urlencode($redirect);
            //dd(route('wechat.thirdAuth',1).'?redirect='.$redirect);
            return redirect(route('wechat.thirdAuth',1).'?auth_token=test&redirect='.$redirect);
        }
    }
}