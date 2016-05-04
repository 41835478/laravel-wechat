<?php

namespace App\Http\Controllers\Wechat;

use App\OldUser;
use App\Wechat;
use App\WechatDomain;
use App\WechatUser;
use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ThirdWechatAuthController extends Controller
{
    /*
     * 第三方授权
     * 接受第三方的重定向url redirect
     * 拉取授权后将用户信息拼接到第三方redirect上
     * 重定向到redirect
     *
     * */
    public function thirdPartyAuthorization(Request $request,$wechatId)
    {
        $third_url = $request->input('redirect');
        if(empty($third_url)){
            return 'redirect参数错误';
        }else{
            $url = explode('?',$third_url);
            $third_url = $url[0];
        }

        $token = $request->input('auth_token');
        $request->session()->put('third_url',$third_url);
        //判断是否授权
        if($request->session()->get('wechat_id', '0')==$wechatId && $request->session()->get('wechat_user', '')!=''){
            //跳转到业务页
            $character = strstr($third_url,'?')?'&':'?';
            $query = http_build_query($request->session()->get('wechat_user', ''));
            $target_url = $third_url.$character.$query;
            return redirect($target_url);
        }else{
            //对比token
            $domain = parse_url(urldecode($third_url));
            $host = $domain['host'];
            $res = WechatDomain::where('domain',$host)->first();
            if($res){
                if($res->token!=$token){
                    return '密钥错误';
                }
            }else{
                return '该域名未经授权';
            }
            //进行授权
            $wechatApp = $this->instanceWechatServer($wechatId);
            $auth = $wechatApp->oauth;
            $response = $auth->scopes(['snsapi_userinfo'])->redirect();
            return $response;
        }
    }


    //微信授权回调页
    public function thirdCallback(Request $request,$wechatId)
    {
        $wechatApp = $this->instanceWechatServer($wechatId);
        $oauth = $wechatApp->oauth;
        $user = $oauth->user();
        $third_url = $request->session()->get('third_url');
        //保存用户信息
        $original = $user->getOriginal();
        $openid = $user->getId();
        $userInfo = [
            'us_weixinid'   => $user['id'],
            'us_nick'  => $original['nickname'],
            'us_gender'  => $original['sex'],
            'city'  => $original['city'],
            'province'  => $original['province'],
            'us_portrait'  => $original['headimgurl'],
            'us_date'  => date('Y-m-d H:i:s',time()),
        ];
        $u = OldUser::where('us_weixinid',$openid)->first();
        if($u){
            OldUser::where('us_weixinid',$openid)->update($userInfo);
        }else{
            $userInfo = array_merge(['us_weixinid'=>$openid],$userInfo);
            OldUser::create($userInfo);
        }
        $status = [
            'status'    => 'ok'
        ];
        $data = array_merge($userInfo,$status);
        $request->session()->put('wechat_id',$wechatId);
        $request->session()->put('wechat_user',$user);
        $character = strstr($third_url,'?')?'&':'?';
        $query = http_build_query($data);
        $target_url = $third_url.$character.$query;
        //跳转到业务页
        // todo
        return redirect($target_url);
    }


    public function instanceWechatServer($wechatId)
    {

        $wechat = Wechat::find($wechatId);

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
                'callback' => route('wechat.thirdCallback',$wechatId),
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

        return new Application($optioins);

    }
}
