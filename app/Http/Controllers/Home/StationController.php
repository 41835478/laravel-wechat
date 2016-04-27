<?php

namespace App\Http\Controllers\Home;

use App\OldUser;
use App\Station;
use App\Wechat;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class StationController extends BaseController
{
    public $wechatApp;

    public $wechat;

    public function __construct()
    {
        parent::__construct();
        $this->wechat = Wechat::find(1);
        $optioins = [
            /**
             * Debug 模式，bool 值：true/false
             *
             * 当值为 false 时，所有的日志都不会记录
             */
            'debug'  => true,

            /**
             * 账号基本信息，请从微信公众平台/开放平台获取
             */
            'app_id'  => $this->wechat->app_id,         // AppID
            'secret'  => $this->wechat->secret,     // AppSecret
            'token'   => $this->wechat->wechat_token,          // Token
            'aes_key' => $this->wechat->encoding_aes_key,                    // EncodingAESKey

            /**
             * 日志配置
             *
             * level: 日志级别, 可选为：
             *         debug/info/notice/warning/error/critical/alert/emergency
             * file：日志文件位置(绝对路径!!!)，要求可写权限
             */
            'log' => [
                'level' => 'debug',
                'file'  => storage_path('logs/wechat.log'),
            ],

            /**
             * OAuth 配置
             *
             * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
             * callback：OAuth授权完成后的回调页地址
             */
            'oauth' => [
                'scopes'   => ['snsapi_userinfo'],
                'callback' => '/examples/oauth_callback.php',
            ],

            /**
             * 微信支付
             */
            'payment' => [
                'merchant_id'        => 'your-mch-id',
                'key'                => 'key-for-signature',
                'cert_path'          => 'path/to/your/cert.pem', // XXX: 绝对路径！！！！
                'key_path'           => 'path/to/your/key',      // XXX: 绝对路径！！！！
                // 'device_info'     => '013467007045764',
                // 'sub_app_id'      => '',
                // 'sub_merchant_id' => '',
                // ...
            ],
        ];
        $this->wechatApp = new Application($optioins);

    }

    public function station()
    {
        $js = $this->wechatApp->js;
        $user = OldUser::where('us_weixinid',$this->user['id'])->first();
        return view('home.station.position',compact('js','user'));
    }

    public function show($id)
    {
        $js = $this->wechatApp->js;
        $shop = Station::find($id);
        $user = OldUser::where('us_weixinid',$this->user['id'])->first();
        return view('home.shop.show',compact('js','shop','user'));
    }
}
