<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 5/15/15
 * Time: 11:48 AM
 */

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\Node;
use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Html;

class PostController extends Controller{

    public function postsList($nodeId='')
    {
        $nodeIds = DB::table('node_hierarchy')->where('node_parent_id','=',$nodeId)->lists('node_id');
        $nodeIds = array_merge($nodeIds,[$nodeId]);
        $nodeIds = implode(',',$nodeIds);
//        if($nodeId==''){
//            $posts = Post::paginate(10);
//            $node = '';
//        }else{
        $posts = Post::whereRaw("node_id in ($nodeIds)")->orderBy('created_at','DESC')->paginate(6);
        $node = Node::find($nodeId);
//        }
        //dd(response()->json(view('home.post.posts',compact('posts'))->render()));
        if(Request::ajax()){
            return response()->json(view('home.post.posts',compact('posts'))->render());
        }

        return view('home.post.index',compact('posts','node'));
    }
    public function all(){
        $posts = Post::all();
        return response()->json($posts);
    }



}