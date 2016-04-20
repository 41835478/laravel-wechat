<?php

namespace App\Http\Controllers;

use App\Keyword;
use App\KeywordRule;
use App\Reply;
use App\WechatNews;
use App\WechatText;
use Illuminate\Http\Request;

use App\Http\Requests;

class ApiController extends Controller
{
    //此接口不提供
    public function getKeywordRules()
    {
        $rules = KeywordRule::with('keywords','replies')->where('wechat_id',1)->paginate(10);
        //dd($rules);
        foreach($rules as $rule){
            //dd($rule);
            foreach($rule->replies as $k=>$reply){
                if($reply->reply_type=='text'){
                    $whereIn = explode(',',$reply->content_id);
                    $text = WechatText::whereIn('id',$whereIn)->first();
                    //dd($text);
                    $rule->replies[$k]->body = $text;
                }elseif($reply->reply_type=='news')
                {
                    $whereIn = explode(',',$reply->content_id);
                    $news = WechatNews::whereIn('id',$whereIn)->first();
                    $rule->replies[$k]->body = $news;
                }
            }
        }

        //dd($rules);
        return response()->json($rules);
    }

    //创建规则
    /*
     * @param $rule_name 规则名称
     * @param $keywords  关键词列表,包括匹配类型
     * @param $replies   回复列表,包括回复类型
     * */
    public function postCreateRule(Request $request)
    {
        $rule_name = $request->input('rule_name');
        $wechat_id = $request->input('wechat_id');
        $keywords  = $request->input('keywords');
        $replies   = $request->input('replies');
        //dd($request->all());
        //添加规则
        $rule = KeywordRule::firstOrCreate([
            'rule_name'     => $rule_name,
            'wechat_id'     => $wechat_id
        ]);
        //关键词列表
        //dd($keywords);
        //$keywords = json_decode($keywords);
//        $keywords = [
//            [
//                'keyword'        => 'test',
//                'match_type'     => 1
//            ],
//            [
//                'keyword'        => 'test2',
//                'match_type'     => 1
//            ],
//            [
//                'keyword'        => 'test3',
//                'match_type'     => 2
//            ],
//        ];

        $kws = [];
        foreach($keywords as $key=>$keyword){
            $has = Keyword::where('keyword_rule_id',$rule->id)->where('keyword',$keyword['keyword'])->first();
            if(empty($has)){
                $kws[] = new Keyword([
                    'keyword'        => $keyword['keyword'],
                    'match_type'     => $keyword['match_type'],
                    'wechat_id'      => $wechat_id
                ]);
            }
        }
        //dd(serialize($keywords));
        //删除原有关键词
        //Keyword::where('keyword_rule_id',$rule->id)->delete();
        //添加关键词
        $rule->keywords()->saveMany($kws);
        //dd($replies);
        //添加回复
        //$replies = json_decode($replies);
//        $replies = [
//            [
//                'message_type'        => 'text',
//                'content'             => '这是文本回复1'
//            ],
//            [
//                'message_type'        => 'text',
//                'content'             => '这是文本回复2'
//            ],
//            [
//                'message_type'        => 'news',
//                'content_id'          => 2
//            ],
//        ];

        $rps = [];
        foreach($replies as $key=>$reply){
            if($reply['message_type']=='text'){
                $text = WechatText::firstOrCreate([
                    'body'  => $reply['content']
                ]);
                $reply['content_id'] = $text->id;
            }
            $has = Reply::where('keyword_rule_id',$rule->id)
                            ->where('message_type',$reply['message_type'])
                            ->where('content_id',$reply['content_id'])
                            ->first();

            if(empty($has)){
                $rps[] = new Reply([
                    'message_type'           => $reply['message_type'],
                    'content_id'             => $reply['content_id'],
                    'wechat_id'              => $wechat_id
                ]);
            }

        }

        //删除原有回复
        //Reply::where('keyword_rule_id',$rule->id)->delete();
        $rule->replies()->saveMany($rps);
        if($rule->id){
            $rule = $this->_getRuleMedias($rule->id);
            $result = ['status'=>200,'msg'=>'添加成功','data'=>$rule];
        }else{
            $result = ['status'=>201,'msg'=>'添加失败'];
        }
        return response()->json($result);
    }

    //更新规则
    public function postUpdateRule(Request $request)
    {
        $rule_id   = $request->input('rule_id');
        $rule_name = $request->input('rule_name');
        $keywords  = $request->input('keywords');
        $replies   = $request->input('replies');
        //更新规则
        $rule = KeywordRule::find($rule_id);
        $rule->rule_name = $rule_name;
        $rule->save();
        //关键词列表
        $kws = [];
        foreach($keywords as $key=>$keyword){
            $has = Keyword::where('keyword_rule_id',$rule->id)->where('keyword',$keyword['keyword'])->first();
            if(empty($has)){
                $kws[] = new Keyword([
                    'keyword'        => $keyword['keyword'],
                    'match_type'     => $keyword['match_type']
                ]);
            }
        }
        //删除原有关键词
        Keyword::where('keyword_rule_id',$rule->id)->delete();
        //添加关键词
        $rule->keywords()->saveMany($kws);

        //添加回复
        $rps = [];
        foreach($replies as $key=>$reply){
            if($reply['message_type']=='text'){
                $text = WechatText::firstOrCreate([
                    'body'  => $reply['content']
                ]);
                $reply['content_id'] = $text->id;
            }
            $has = Reply::where('keyword_rule_id',$rule->id)
                ->where('message_type',$reply['message_type'])
                ->where('content_id',$reply['content_id'])
                ->first();

            if(empty($has)){
                $rps[] = new Reply([
                    'message_type'           => $reply['message_type'],
                    'content_id'             => $reply['content_id']
                ]);
            }

        }

        //删除原有回复
        Reply::where('keyword_rule_id',$rule->id)->delete();
        $rule->replies()->saveMany($rps);
        if($rule->id){
            $rule = $this->_getRuleMedias($rule->id);
            $result = ['status'=>200,'msg'=>'更新成功','data'=>$rule];
        }else{
            $result = ['status'=>201,'msg'=>'更新失败'];
        }
        return response()->json($result);
    }

    //删除规则
    public function postDeleteRule(Request $request)
    {
        $res = KeywordRule::destroy($request->input('rule_id'));
        if($res){
            $result = ['status'=>200,'msg'=>'删除成功'];
        }else{
            $result = ['status'=>201,'msg'=>'删除失败'];
        }
        return response()->json($result);
    }

    //获取图文列表
    public function getNewsLists(Request $request)
    {
        $last_id = $request->input('last_id');
        $wechat_id = $request->input('wechat_id');
        $query = WechatNews::where('wechat_id',$wechat_id);
        if($last_id){
            $query->where('id','>',$last_id);
        }
        $news = $query->take(10)->get();
        return response()->json($news);
    }

    //获取规则下图文内容

    protected function _getRuleMedias($rule_id)
    {
        $rule = KeywordRule::with('keywords','replies')->find($rule_id);
            //dd($rule);
        foreach($rule->replies as $k=>$reply){
            if($reply->reply_type=='text'){
                $whereIn = explode(',',$reply->content_id);
                $text = WechatText::whereIn('id',$whereIn)->first();
                //dd($text);
                $rule->replies[$k]->body = $text;
            }elseif($reply->reply_type=='news')
            {
                $whereIn = explode(',',$reply->content_id);
                $news = WechatNews::whereIn('id',$whereIn)->first();
                $rule->replies[$k]->body = $news;
            }
        }
        return $rule;
    }

    //以下不需要
}
