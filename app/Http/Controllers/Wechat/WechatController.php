<?php namespace App\Http\Controllers\Wechat;
use App\Http\Controllers\Controller;

/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 6/15/15
 * Time: 2:53 PM
 */
use App\Keyword;
use App\Wechat;
use App\WechatNews;
use Overtrue\Wechat\Server;
use Overtrue\Wechat\Message;
/*
 * 微信交互控制器
 *
 * */
class WechatController extends Controller{

    public function index($wechatId)
    {
        //获取微信公众号信息
        $wechat = Wechat::find($wechatId);

        $appId          = $wechat->app_id;
        $token          = $wechat->wechat_token;
        $encodingAESKey = $wechat->encoding_aes_key; // 可选

        // $encodingAESKey 可以为空
        $server = new Server($appId, $token, $encodingAESKey);

        /*
         * 监听指定类型
         * */
        $server->on('message', 'text', function($message) {
            return $this->reply($message);
        });

        $result = $server->serve();

        return $result;
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
                return Message::make($content['reply_type'])->content($content->content);
                break;
            default:
                return Message::make($content['reply_type'])->content($content->content);
                break;
            case 'news':
                //查询内容
                $news = WechatNews::find($content->content);
                return Message::make('news')->items(function() use ($news){
                    return array(
                        Message::make('news_item')->title($news->title)->url($news->news_url)->picUrl($news->cover),
                    );
                });
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