<?php namespace App\Repositories\WechatRepositories;
use App\WechatNews;

/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 7/27/15
 * Time: 4:19 PM
 */

class NewsRepository {
    public function create(array $data,$wechatId)
    {
        return WechatNews::create([
            'wechat_id' => $wechatId,
            'title' => $data['title'],
            'author' => $data['author'],
            'pic_url' => $data['pic_url'],
            'description' => $data['description'],
            'news_url' => $data['news_url'],
            'body' => $data['body'],
        ]);
    }

    public function update(array $data,$id)
    {
        $news = WechatNews::find($id)->update($data);
        return $news;
    }
} 