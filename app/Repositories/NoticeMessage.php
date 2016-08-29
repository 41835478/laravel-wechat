<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 16/6/16
 * Time: 下午3:57
 */

namespace App\Repositories;


use App\Wechat;
use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;

class NoticeMessage
{
    public function sendNotice($openid,$templateId,$url,$data)
    {
        $wechat_app = $this->wechatApp();
        $notice = $wechat_app->notice;

        $userId = $openid;
//        $templateId = 'JpLoTHO4f6tyLdtMU7_v-KK8ikjnvXXh4ncRWq60kI4';
//        $url = 'http://landwind.socialplus.com.cn/packet/public/index.php/index/receive';
        $color = '#FF0000';
//        $data = array(
//            "first"      => "恭喜你中得背包大奖！",
//            "keyword1"   => "陆风汽车红包活动",
//            "keyword2"   => "背包一个",
//            "remark"     => "感谢您的参与！",
//        );
        $messageId = $notice->uses($templateId)->withUrl($url)->withColor($color)->andData($data)->andReceiver($userId)->send();
        return $messageId;
    }

    public function wechatApp($wechat_id=1)
    {
        $wechat = Wechat::find($wechat_id);

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
            'app_id'  => $wechat->app_id,         // AppID
            'secret'  => $wechat->secret,     // AppSecret
            'token'   => $wechat->wechat_token,          // Token
            'aes_key' => $wechat->encoding_aes_key,                    // EncodingAESKey

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
                'merchant_id'        => $wechat->mch_id,
                'key'                => $wechat->key,
                'cert_path'          => base_path('cert/apiclient_cert.pem'), // XXX: 绝对路径！！！！
                'key_path'           => base_path('cert/apiclient_key.pem'),      // XXX: 绝对路径！！！！
                // 'device_info'     => '013467007045764',
                // 'sub_app_id'      => '',
                // 'sub_merchant_id' => '',
                // ...
            ],
        ];

        $this->wechatApp = new Application($optioins);

        return $this->wechatApp;
    }
}