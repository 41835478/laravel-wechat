<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 6/19/15
 * Time: 3:57 PM
 */

namespace App\Repositories;

use App\Wechat;
use Illuminate\Support\Facades\Auth;

class WechatRepository {
    public function create(array $data)
    {
        return Wechat::create([
            "user_id" => Auth::id(),
            "public_name" => $data['public_name'],
            "original_id" => $data['original_id'],
            "wechat_account" => $data['wechat_account'],
            "avatar" => $data['avatar'],
            "wechat_type" => $data['wechat_type'],
            "app_id" => $data['app_id'],
            "secret" => $data['secret'],
            "encoding_aes_key" => $data['encoding_aes_key'],
            "wechat_token" => $data['wechat_token'],
            "mch_id"    => $data['mch_id'],
            "send_name"    => $data['send_name'],
            "key"       => $data['key'],
            "cert_path"    => $data['cert_path'],
            "key_path"    => $data['key_path'],
        ]);
    }

    public function update(array $data,$id)
    {
        $wechat = Wechat::find($id);
        $wechat->public_name = $data['public_name'];
        $wechat->original_id = $data['original_id'];
        $wechat->wechat_account = $data['wechat_account'];
        $wechat->avatar = $data['avatar'];
        $wechat->app_id = $data['app_id'];
        $wechat->secret = $data['secret'];
        $wechat->encoding_aes_key = $data['encoding_aes_key'];
        $wechat->wechat_token = $data['wechat_token'];
        $wechat->mch_id    = $data['mch_id'];
        $wechat->send_name    = $data['send_name'];
        $wechat->key       = $data['key'];
        $wechat->cert_path   = $data['cert_path'];
        $wechat->key_path    = $data['key_path'];
        $wechat->save();
        return $wechat;
    }
} 