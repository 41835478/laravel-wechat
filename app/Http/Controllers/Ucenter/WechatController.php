<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 6/18/15
 * Time: 3:17 PM
 */

namespace App\Http\Controllers\Ucenter;


use App\Http\Requests\WechatRequest;
use App\Keyword;
use App\KeywordRule;
use App\Repositories\KeywordRuleRepository;
use App\Repositories\WechatKeywordRepository;
use App\Repositories\WechatReplyRepository;
use App\Repositories\WechatRepository;
use App\Wechat;
use App\WechatNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WechatController extends BaseController{

    protected $public;

    protected $keyword_rule;

    protected $keyword;

    protected $reply;

    public function __construct(WechatRepository $wechatRepository,KeywordRuleRepository $ruleRepository,
                                WechatKeywordRepository $wechatKeywordRepository,WechatReplyRepository $wechatReplyRepository)
    {
        $this->public = $wechatRepository;
        $this->keyword_rule = $ruleRepository;
        $this->keyword = $wechatKeywordRepository;
        $this->reply=$wechatReplyRepository;
    }

    public function index()
    {
        $wechats = Wechat::paginate(20);
        return view('ucenter.public.index',compact('wechats'));
    }

    public function create()
    {
        return view('ucenter.public.create');
    }

    public function store(WechatRequest $request)
    {
        $result = $this->public->create($request->all());
        return $this->message($result);
    }

    public function edit($wechatId)
    {
        $wechat = Wechat::find($wechatId);
        return view('ucenter.public.edit',compact('wechat'));
    }

    public function update(WechatRequest $request,$id)
    {
        $result = $this->public->update($request->all(),$id);
        return $this->message($result);
    }

    public function destroy($id)
    {

    }

    public function manage()
    {
        return view('ucenter.public.manage');
    }

    public function message($result)
    {
        if($result->id) {
            flash()->success('操作成功');
        }else{
            flash()->error('操作失败');
        }
        return redirect()->route('ucenter.wechat');
    }

    /*
     * 素材管理
     * */

    public function media($wechatId)
    {
        return view('ucenter.public.media');
    }

    public function mediaType($wechatId,$type)
    {
        switch($type){
            case 'news':
                $media = WechatNews::paginate(15);
                break;
        }
        return view('ucenter.public.media.type',compact('media'));
    }

    /*
     * 自动回复
     * */

    public function reply($wechatId)
    {
        return view('ucenter.public.reply');
    }

    public function replyType($wechatId,$type)
    {
        $keyword_rules = KeywordRule::with(['keywords','reply.text'])->where('wechat_id','=',$wechatId)->Orderby('created_at','DESC')->paginate(15);
        return view('ucenter.public.reply.type',compact('keyword_rules'));
    }

    public function ruleStore(Request $request)
    {
        if($request->ajax()){
            $keyword_rule = $this->keyword_rule->create($request->all());
            if($keyword_rule){
                $result = ['status'=>'success','msg'=>'添加成功！','keyword_rule'=>$keyword_rule];
            }else{
                $result = ['status'=>'fail','msg'=>'添加失败！'];
            }
            return $result;
        }
    }

    public function keywordsStore(Request $request)
    {
        if($request->ajax()){
            //添加关键字到指定的规则
            $keyword = $this->keyword->create($request->all());
            if($keyword){
                $result = ['status'=>'success','msg'=>'添加成功！','form_type'=>$request->all()['form_type'],'keyword'=>$keyword];
            }else{
                $result = ['status'=>'fail','msg'=>'添加失败！','form_type'=>$request->all()['form_type']];
            }
            return $result;
        }
    }

    public function keywordsUpdate(Request $request)
    {
        if($request->ajax()){
            $keyword = $this->keyword->update($request->all());
            if($keyword){
                $result = ['status'=>'success','msg'=>'更新成功！','form_type'=>$request->all()['form_type'],'keyword'=>$keyword];
            }else{
                $result = ['status'=>'fail','msg'=>'更新失败！','form_type'=>$request->all()['form_type']];
            }
            return $result;
        }
    }

    //添加回复文字
    public function replyText(Request $request)
    {
        if($request->ajax()){
            $reply = $this->reply->createTextReply($request->all());
            if($reply){
                $result = ['status'=>'success','msg'=>'添加成功！','form_type'=>$request->all()['form_type'],'reply'=>$reply];
            }else{
                $result = ['status'=>'fail','msg'=>'添加失败！','form_type'=>$request->all()['form_type']];
            }
            return $result;
        }
    }

    //添加回复图文
    public function replyNews(Request $request)
    {
        if($request->ajax()){
            $reply = $this->reply->createNewsReply($request->all());
            if($reply){
                $result = ['status'=>'success','msg'=>'添加成功！','form_type'=>$request->all()['form_type'],'reply'=>$reply];
            }else{
                $result = ['status'=>'fail','msg'=>'添加失败！','form_type'=>$request->all()['form_type']];
            }
            return $result;
        }
    }

}