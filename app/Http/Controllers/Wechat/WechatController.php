<?php namespace App\Http\Controllers\Wechat;
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 6/15/15
 * Time: 2:53 PM
 */
use App\Keyword;
use App\Reply;
use App\Wechat;
use App\WechatNews;
use App\WechatText;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\Article;
use EasyWeChat\Message\Text;
use Guzzle\Common\Collection;
use Illuminate\Support\Facades\Auth;

/*
 * 微信交互控制器
 *
 * */
class WechatController extends WechatBaseController{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($wechatId)
    {
        $wechatApp = $this->instanceWechatServer($wechatId);
        //事件服务
        $server = $wechatApp->server;
        //接收事件
        $server->setMessageHandler(function($message) use ($wechatId,$wechatApp){
            // 注意，这里的 $message 不仅仅是用户发来的消息，也可能是事件
            // 当 $message->MsgType 为 event 时为事件
            if ($message->MsgType == 'event') {
                # code...
                switch ($message->Event) {
                    case 'subscribe':
                        //查询当前公众号关注事件自动回复
                        //todo
                        $reply = Reply::with('text')->where(['wechat_id'=>$wechatId])->first();

                        $text = new Text();
                        $text->content = $reply->text->content;

                        return $text;

                        break;

                    case 'CLICK':

                        $text = new Text();
                        $text->content = '这是自定义点击事件';

                        return $text;

                        break;

                    case 'VIEW':

                        $text = new Text();
                        $text->content = '这是自定义VIEW事件';

                        return $text;

                        break;
                    default:
                        # code...
                        break;
                }
            }elseif($message->MsgType == 'text'){
                if($message->Content=='客服'){
                    //多客服转发
                    return new \EasyWeChat\Message\Transfer();
                }else{
                    //关键字自动回复处理
                    $this->reply($message);
                }

            }
        });


        $response = $server->serve()->send();
        return $response;
    }

    public function reply($message)
    {
        /*
         * 监听事件类型
         * 关注事件回复
         * */
//        $message = (object)[
//            'Content'=>'test',
//            'ToUserName'=>'gh_68f0112f08be'
//        ];
        //$message=collect($arr);
        //dd($arr->Content);
        //获取公众号信息
        $public_number = $message->ToUserName;  //公众号原始ID
        $wechat = Wechat::where('original_id','=',$public_number)->firstOrFail();

        //查询关键字,预载入关键字规则
        $keyword = Keyword::with(['keywordRule'=>function($query) use ($wechat){
            $query->where('wechat_id','=',$wechat->id);
        }])->where('keyword','like',"$message->Content")->first();

        //查询对应回复   一对多
        $replies = $keyword->keywordRule->replies;
        dd($replies);
//        foreach ($replies as $key => $reply) {
//            $contents[$key] = $reply->{$reply->reply_type};
//            $contents[$key]['reply_type'] = $reply->reply_type;
//        }
        //
        //dd($contents);
        //取随机数
        $num = mt_rand(0,count($replies)-1);

        $content = $replies[$num];

        switch($content['message_type'])
        {
            case 'text':
                //查询text
                $rep = WechatText::find($content['content_id']);
                $text = new Text();
                $text->content = $rep->body;

                return $text;
                break;
            case 'image':
            case 'voice':
            case 'video':
            case 'location':
                //return Message::make($content['reply_type'])->content($content->content);
                break;
            default:
                //return Message::make($content['reply_type'])->content($content->content);
                break;
            case 'news':
                //查询内容
                $news = WechatNews::find($content->content);
                $res = new News([
                    'title'         => $news->title,
                    'image'         => $news->pic_url,
                    'description'   => $news->description,
                    'url'           => $news->news_url
                ]);

                return $res;
                break;
        }
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
                'callback' => url('wechat/'.$wechatId.'/webAuth'),
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


    //微信网页授权
    public function webAuthorization($wechatId)
    {
        //判断是否授权
        if(Auth::check()){

        }else{
            $wechatApp = $this->instanceWechatServer($wechatId);
            $auth = $wechatApp->oauth;
            $response = $auth->scopes(['snsapi_userinfo'])->redirect();
            return $response;
        }
    }
}