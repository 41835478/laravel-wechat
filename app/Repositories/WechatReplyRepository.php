<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 7/22/15
 * Time: 4:39 PM
 */

namespace App\Repositories;


use App\Reply;
use App\ReplyNews;
use App\ReplyText;
use Illuminate\Support\Facades\DB;

class WechatReplyRepository {

    public function createTextReply(array $data)
    {
        $reply = Reply::Create([
            'keyword_rule_id' =>$data['keyword_rule_id'],
            'reply_type' => $data['reply_type']
        ]);

        ReplyText::firstOrCreate([
            'content' => $data['msg_content'],
            'reply_id' => $reply->id
        ]);


        return Reply::with('text')->find($reply->id);
    }

    public function updateTextReply(array $data)
    {

    }

    public function createNewsReply(array $data)
    {
        $reply = Reply::Create([
            'keyword_rule_id' =>$data['keyword_rule_id'],
            'reply_type' => $data['reply_type']
        ]);

        ReplyNews::firstOrCreate([
            'reply_id' => $reply->id,
            'content' => $data['msg_content']
        ]);
        return Reply::with('news')->find($reply->id());
    }
} 