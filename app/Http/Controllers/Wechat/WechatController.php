<?php namespace App\Http\Controllers\Wechat;
use App\Http\Controllers\Admin\WechatBaseController;
use App\Http\Controllers\Controller;

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
use EasyWeChat\Message\Text;

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
        //事件服务
        $server = $this->wechatApp->server;
        //接收事件
        $server->setMessageHandler(function($message) use ($wechatId){
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

                    case 'click':

                        return "这是自定义点击事件!";

                        break;

                    default:
                        # code...
                        break;
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

        //获取公众号信息
        $public_number = $message->ToUserName;
        $wechat = Wechat::where('wechat_account','=',$public_number)->firstOrFail();
        //获取关键词对象
        $message->Content;
        //查询关键字,预载入关键字规则
        $keyword = Keyword::with(['keywordRule'=>function($query) use ($wechat){
            $query->where('wechat_id','=',$wechat->id);
        }])->where('keyword','like',"$message->Content")->first();
        //查询对应回复   一对多
        $replies = $keyword->keywordRule->reply;
        //dd($replies);
        foreach ($replies as $key => $reply) {
            $contents[$key] = $reply->{$reply->reply_type};
            $contents[$key]['reply_type'] = $reply->reply_type;
        }
        //取随机数
        $num = mt_rand(0,count($replies));

        $content = $contents[$num];

        switch($content['reply_type'])
        {
            case 'text':
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
//                return Message::make('news')->items(function() use ($news){
//                    return array(
//                        Message::make('news_item')->title($news->title)->url($news->news_url)->picUrl($news->cover),
//                    );
//                });
                breadk;
        }
    }

    /*
     * 获取回复消息对象
     * 关注回复、关键字回复、自定义菜单等。
     * */
    public function getMessageObject()
    {
         //return $message;
        return 'text';
    }


}