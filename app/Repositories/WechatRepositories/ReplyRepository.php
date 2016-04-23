<?php namespace App\Repositories\WechatRepositories;
use App\Reply;
use App\ReplyText;
use App\WechatNews;

/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 7/27/15
 * Time: 4:19 PM
 */

class ReplyRepository {

    public function create(array $data,$wechatId)
    {
        //创建自动回复内容
        $reply = Reply::firstOrCreate([
            'wechat_id'     => $wechatId,
            'message_type'  => 'event',
            'reply_type'    => $data['reply_type'],
        ]);

        if($reply){
           ReplyText::firstOrCreate([
               'reply_id'  => $reply->id,
               'content'   => $data['content']
           ]);
            return $reply;
        }else{
            return false;
        }
    }

    public function update(array $data,$id)
    {
        $data = array_only($data,'content');
        $text = ReplyText::find($id)->update($data);
        return $text;
    }
} 