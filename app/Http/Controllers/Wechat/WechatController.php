<?php namespace App\Http\Controllers\Wechat;
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 6/15/15
 * Time: 2:53 PM
 */
use App\Keyword;
use App\OldUser;
use App\Reply;
use App\ReplyText;
use App\Wechat;
use App\WechatNews;
use App\WechatText;
use App\WechatThirdApi;
use EasyWeChat\Core\AccessToken;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\Article;
use EasyWeChat\Message\News;
use EasyWeChat\Message\Text;
use Guzzle\Common\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

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
                        $reply = ReplyText::where(['wechat_id'=>$wechatId])->first();

                        $text = new Text();
                        $text->content = $reply->content;

                        return $text;

                        break;

                    case 'CLICK':

                        return $this->reply($message);

                        break;

                    default:
                        return '';
                        break;
                }
            }elseif($message->MsgType == 'text'){
                if($message->Content=='9'){
                    //多客服转发
                    return new \EasyWeChat\Message\Transfer();
                }else{
                    //关键字自动回复处理
                    return $this->reply($message);
                }

            }elseif($message->MsgType == 'image'){

                return $this->reply($message);
            }
        });


        $response = $server->serve()->send();
        return $response;
    }

    public function reply($message)
    {
//        $message = (object)[
//            'FromUserName'=>'o6ScNt3LgjkO9T6kJxY3mSGHsVYU',
//            'ToUserName'=> 'gh_68f0112f08be',
//            'MsgType'   => 'text',
//            'Content'    => '第三方',
//        ];
        //缓存用户消息
        $image = $this->cacheUserKeyword($message);

        //获取公众号信息
        $public_number = $message->ToUserName;  //公众号原始ID
        $wechat = Wechat::where('original_id','=',$public_number)->firstOrFail();

        //查询关键字,预载入关键字规则
        if($message->MsgType=='event' && $message->Event=='CLICK'){
            //return $message->MsgType.'--'.$message->EventKey.'-'.$message->Event;
            $keyword = $message->EventKey;
        }elseif($message->MsgType=='image'){
            //判断是否是图片,并缓存,如果缓存存在后面的用户发送消息将直接转发
            if($image){
                $keyword = '第三方';//设置默认关键词
                $third = $this->forward($keyword,$wechat->id);
                if($third){
                    return $third;
                }
            }
        }else{
            $keyword = $message->Content;
        }
        //dd($keyword);
        $rep = $this->getReplyByKeyword($keyword,$wechat);

        if(empty($rep)){
            //查看第三方接口
            $third_api = WechatThirdApi::where('keyword',$keyword)->where('wechat_id',$wechat->id)->first();
            if($third_api && $third_api->status==1){
                $response = $this->forward($third_api->keyword,$wechat->id);
                if($response){
                    return $response;
                }
            }
            $keyword = '消息自动回复';
            return $this->getReplyByKeyword($keyword,$wechat);
        }else{
            return $rep;
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
                'callback' => route('wechat.callback',$wechatId),
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

        $app = new Application($optioins);
        return $app;

    }

    /*
     * 根据关键字获取回复
     * */

    public function getReplyByKeyword($kw,$wechat)
    {

        $keyword = Keyword::with(['keywordRule'=>function($query) use ($wechat){
                        $query->where('wechat_id','=',$wechat->id);
                    }])->where('keyword','like',"$kw")->first();
        if($keyword){

            //查询对应回复   一对多
            $replies = $keyword->keywordRule->replies;

            if(count($replies)>0){
                //取随机数
                $num = mt_rand(0,count($replies)-1);

                $content = $replies[$num];

                switch($content->message_type)
                {
                    case 'text':
                        //查询text
                        $rep = WechatText::find($content->content_id);
                        if(empty($rep)){
                            return '';
                        }
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
                        $ids = explode(',',$content->content_id);

                        //查询内容
                        if(count($ids)==1){
                            $news = WechatNews::find($content->content_id);
                            if(empty($news)){
                                return '';
                            }

                            $res = new News([
                                'title'         => $news->title,
                                'image'         => url($news->pic_url),
                                'description'   => $news->description,
                                'url'           => $news->news_url
                            ]);
                        }elseif(count($ids)>1){
                            $news = WechatNews::whereIn('id',$ids)->get();
                            $res = [];
                            foreach($news as $item){
                                $n = new News([
                                    'title'         => $item->title,
                                    'image'         => url($item->pic_url),
                                    'description'   => $item->description,
                                    'url'           => $item->news_url
                                ]);
                                $res[] = $n;
                            }
                        }
                        return $res;
                        break;
                }

            }else{
                return '';
            }

        }else{
            return '';
        }
    }


    //微信网页授权
    public function webAuthorization(Request $request,$wechatId)
    {
        //判断是否授权
        if($request->session()->get('wechat_id', '0')==$wechatId && $request->session()->get('wechat_user', '')!=''){
           //跳转到业务页
            $target_url = $request->session()->put('target_url',$request->url());
            return redirect($target_url);
        }else{
            //进行授权
            $wechatApp = $this->instanceWechatServer($wechatId);
            $auth = $wechatApp->oauth;
            $response = $auth->scopes(['snsapi_userinfo'])->redirect();
            return $response;
        }
    }

    //微信授权回调页
    public function webCallBack(Request $request,$wechatId)
    {
        $wechatApp = $this->instanceWechatServer($wechatId);
        $oauth = $wechatApp->oauth;
        $user = $oauth->user();

        $request->session()->put('wechat_id',$wechatId);
        $request->session()->put('wechat_user',$user);

        //var_dump($request->session()->all());
        //$request->session()->flush();
        //保存用户信息
        $original = $user->getOriginal();
        $openid = $user->getId();
        $userInfo = [
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
        //跳转到业务页
        // todo
        return redirect($request->session()->get('target_url'));
    }

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
        //进行授权
        $wechatApp = $this->instanceWechatServer($wechatId);
        $auth = $wechatApp->oauth;
        $response = $auth->scopes(['snsapi_userinfo'])->redirect();
        return $response;
    }

    /*
     * 转发到第三方平台
     * */

    public function forward($keyword="",$wechat_id,$type="default")
    {
        //获取对应的第三方融合接口信息
        $apiInfo = WechatThirdApi::where('wechat_id',$wechat_id)
                                    ->where('status',1)
                                    ->where('keyword',$keyword)->first();
        //dd($apiInfo);
        if($apiInfo){
            $timestamp = time();//构造时间戳

            $nonce = 8; //随机码

            $token = $apiInfo->token; //token

            $tmpArr = array($token, $timestamp, $nonce);
            sort($tmpArr, SORT_STRING); //排序
            $tmpStr = implode( $tmpArr );

            $tmpStr = sha1( $tmpStr );

            $signature = $tmpStr;

            $argus = array('signature'=>$signature, 'timestamp'=>$timestamp, 'nonce'=>$nonce);

            //构造第三方URL
            $url="";

            if(strstr($apiInfo->api_url,"?")){
                $url=$apiInfo->api_url."&".http_build_query($argus);

            }else{
                $url=$apiInfo->api_url."?".http_build_query($argus);
            }
            //需要POST的微信xml数据包
            $post_data = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");

            $header [] = "Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0";

            $header [] = "Content-Type: text/xml; charset=utf-8"; // 定义content-type为xml

            $ch = curl_init (); // 初始化curl

            curl_setopt ( $ch, CURLOPT_URL,$url); //设置链接

            curl_setopt ( $ch, CURLOPT_HTTPHEADER, $header ); // 设置HTTP头
            curl_setopt ($ch, CURLOPT_TIMEOUT, 3);
            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 ); // 设置是否返回信息
            //将自定义菜单数据包伪造成关键字xml数据包

            if($type=="custom"){

                $postObj = simplexml_load_string( $post_data, 'SimpleXMLElement', LIBXML_NOCDATA);

                $post_data=str_replace("<MsgType><![CDATA[event]]></MsgType>","<MsgType><![CDATA[text]]></MsgType>",$post_data);

                $post_data=str_replace("<Event><![CDATA[CLICK]]></Event>","<Content><![CDATA[".$keyword."]]></Content>",$post_data);

                $post_data=str_replace("<EventKey><![CDATA[".$postObj->EventKey."]]></EventKey>","<MsgId>".time().time()."</MsgId>",$post_data);

                curl_setopt ( $ch, CURLOPT_POSTFIELDS,$post_data); // POST数据
            }

            //原本就是关键字数据包则无需伪造，直接转发
            else{
                curl_setopt ( $ch, CURLOPT_POSTFIELDS,$post_data); // POST数据
            }
            $response = curl_exec ( $ch ); // 接收返回信息

            if (curl_errno ( $ch )) {
                // 出错则显示错误信息
            }
            curl_close ( $ch );
            //返回第三方处理后的结果包
            //清除缓存
            //返回打印信息后清理缓存
            return $response;
        }else{
            return '';
        }

    }

    /*
     * 缓存用户发送消息
     * */
    public function cacheUserKeyword($message,$minutes=60)
    {
//        $message = (object)[
//            'FromUserName'=>'o6ScNt3LgjkO9T6kJxY3mSGHsVYU',
//            'ToUserName'=> 'gh_68f0112f08be',
//            'MsgType'   => 'image',
//            'PicUrl'    => 'this is a url',
//            'MediaId'   => 'media_id',
//            'MsgId'     => '1234567890123456'
//        ];
        //关键字与第三方关键字对应
        //缓存关键字
//        Redis::set('wechat_user',$openid);
//        Redis::set('wechat_user:'.$openid.':keyword',$keyword);
//        Redis::expire('wechat_user:'.$openid.':keyword',30);  # 设置生存时间为30秒 //return (integer) 1
//        $data = Redis::get('wechat_user:'.$openid.':keyword');
        $openid = $message->FromUserName;

        if($message->MsgType=='image'){
            Cache::add("wechat_user:".$openid.":image",$message,$minutes);
        }

        $image =Cache::get("wechat_user:".$openid.":image");
        return $image;
    }

    /*
     * 清除微信session
     * */

    public function logout(Request $request)
    {
        $request->session()->flush();
        return '退出成功';
    }
}