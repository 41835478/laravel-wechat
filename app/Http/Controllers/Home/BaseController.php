<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 15/3/27
 * Time: 下午2:34
 */

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\OldUser;
use Illuminate\Support\Facades\Input;

class BaseController extends Controller
{

    public $wechat_id;

    public $user;

    public function __construct()
    {
        $debug = Input::get('debug');
        if($debug==1){
            $user_id = Input::get('user_id')?Input::get('user_id'):1;
            $this->user['id'] = OldUser::find($user_id)->us_weixinid;
        }else{

            $this->middleware('wechat');

            $this->wechat_id = session()->get('wechat_id');

            $this->user = session()->get('wechat_user');
        }
        }

} 