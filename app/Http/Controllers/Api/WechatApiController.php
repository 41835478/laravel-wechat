<?php

namespace App\Http\Controllers\Api;

use App\PacketRecord;
use App\Wechat;
use App\WechatPacket;
use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class WechatApiController extends Controller
{
    /*
     * 发裂变红包
     * @param openid 种子用户openid
     * @param packet_id 红包活动ID
     * @token token  公众号token,md5加密
     * */
    public function fissionPacket(Request $request)
    {
        //dd(md5('secret'));
        $data = $request->only(['openid','packet_id','sign']);

        $rules = [
            'openid'          => 'required',
            'packet_id'       => 'required',
            'sign'            => 'required',
        ];
        $message = [
            'openid.required'           => 'openid参数错误',
        ];
        //查找token
        $pack = WechatPacket::with('wechat')->find($data['packet_id']);

        if($pack){
            if($pack->status!=1){
                $result = [
                    'status'    => 201,
                    'msg'       => '该接口不可用'
                ];
                return response()->json($result);
            }
            if($pack->times<1){
                $result = [
                    'status'    => 201,
                    'msg'       => '该红包已发放完'
                ];
                return response()->json($result);
            }
            //md5签名
            if($data['sign']!=md5($data['packet_id'].$pack->sign_key.$pack->wechat->wechat_token)){
                $result = [
                    'status'    => 201,
                    'msg'       => '签名错误'
                ];
                return response()->json($result);
            }
        }
        $validator = Validator::make($data,$rules,$message);
        //判断时间
        $time = time();

        if($time>strtotime(date('Y-m-d',time())) && $time<strtotime(date('Y-m-d',time()).' 08:00:00')){
            $result = [
                'status'    => 201,
                'msg'       => '暂时不能发送红包,请在08:00-24:00参与活动'
            ];
            return response()->json($result);
        }
        if($validator->fails()){
            $result = [
                'status'    => 201,
                'msg'       => $validator->errors()->first()
            ];
        }else{
            $packet = $this->wechatApp($data['packet_id']);

            $luckyMoney = $packet['wechatApp']->lucky_money;

            $mch_billno = $packet['packet']->wechat->mch_id.date('YmdHis',time()).rand(1000,9999);
            $luckyMoneyData = [
                'mch_billno'       => $mch_billno,
                'send_name'        => $packet['packet']->wechat->send_name,
                're_openid'        => $data['openid'],
                'total_num'        => $packet['packet']->total_num,  //不小于3
                'total_amount'     => $packet['packet']->total_amount,  //单位为分，不小于300
                'wishing'          => $packet['packet']->wishing,
                //'client_ip'        => '192.168.0.1',  //可不传，不传则由 SDK 取当前客户端 IP
                'act_name'         => $packet['packet']->act_name,
                'remark'           => $packet['packet']->remark,
                'amt_type'         => $packet['packet']->amt_type,  //可不传
                // ...
            ];
            $res = $luckyMoney->sendGroup($luckyMoneyData);
            if($res->return_code=='SUCCESS'){

                if($res->err_code){
                    $result = [
                        'status'    => 201,
                        'msg'       => $res->err_code_des
                    ];
                }else{
                    //红包发送日志
                    PacketRecord::create([
                        'packet_id' => $data['packet_id'],
                        'openid'    => $data['openid'],
                        'mch_billno'=> $mch_billno
                    ]);
                    //更新红包订单
                    $p = WechatPacket::find($data['packet_id']);
                    $p->times -= $p->times;
                    $p->save();
                    $result = [
                        'status'    => 200,
                        'msg'       => '发送成功'
                    ];
                }

            }else{
                $result = [
                    'status'    => 201,
                    'msg'       => '网络错误'
                ];
            }
        }
        return response()->json($result);
    }

    public function wechatApp($packet_id)
    {
        $packet = WechatPacket::with('wechat')->find($packet_id);

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
            'app_id'  => $packet->wechat->app_id,         // AppID
            'secret'  => $packet->wechat->secret,     // AppSecret
            'token'   => $packet->wechat->wechat_token,          // Token
            'aes_key' => $packet->wechat->encoding_aes_key,                    // EncodingAESKey

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
                'merchant_id'        => $packet->wechat->mch_id,
                'key'                => $packet->wechat->key,
                'cert_path'          => base_path('cert/apiclient_cert.pem'), // XXX: 绝对路径！！！！
                'key_path'           => base_path('cert/apiclient_key.pem'),      // XXX: 绝对路径！！！！
                // 'device_info'     => '013467007045764',
                // 'sub_app_id'      => '',
                // 'sub_merchant_id' => '',
                // ...
            ],
        ];

        $this->wechatApp = new Application($optioins);

        return $result = [
            'wechatApp'  => $this->wechatApp,
            'packet'     => $packet
        ];
    }

}
