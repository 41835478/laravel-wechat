<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 15/3/30
 * Time: 下午4:10
 */

namespace App\Repositories;

use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostRepository {

    public function create(array $data)
    {
        return Post::create([
                'user_id' => Auth::id(),
                'title' => $data['title'],
                'photo' => $data['photo'],
                'post_url' => $data['post_url'],
                'shop_name' => $data['shop_name'],
                'node_id' => $data['node_id'],
            ]);
    }

    public function update(array $data,$id)
    {
        $post = Post::find($id);
        $post->user_id = Auth::id();
        $post->title = $data['title'];
        $post->photo = $data['photo'];
        $post->post_url = $data['post_url'];
        $post->shop_name = $data['shop_name'];
        $post->node_id = $data['node_id'];
        $post->save();
        return $post;
    }
} 