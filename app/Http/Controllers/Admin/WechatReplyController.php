<?php

namespace App\Http\Controllers\Admin;

use App\Reply;
use App\Repositories\WechatRepositories\ReplyRepository;
use App\Wechat;
use Illuminate\Http\Request;

use App\Http\Requests;

class WechatReplyController extends BaseController
{
    public $reply;
    public function __construct(ReplyRepository $replyRepository)
    {
        $this->reply = $replyRepository;
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //查询回复规则
        $replies = Reply::paginate(10);
        return view('admin.reply.index',compact('replies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //关注事件
    public function subscribeCreate()
    {
        $wechat = Wechat::where('user_id',$this->user->id)->firstOrFail();
        //查询自动回复
        $reply = Reply::with('text')->where('wechat_id',$wechat->id)->first();
        if($reply){
            return view('admin.reply.subscribeEdit',compact('wechat','reply'));
        }else{
            return view('admin.reply.subscribeCreate',compact('wechat'));
        }
    }

    public function subscribeStore(Request $request)
    {
        $data = $request->except('_token');
        $result = $this->reply->create($data,$data['wechat_id']);
        if($result) {
            flash()->success('发布成功');
        }else{
            flash()->error('发布失败');
        }
        return redirect()->back();
    }

    public function subscribeUpdate(Request $request)
    {
        $data = $request->except('_token');
        $result = $this->reply->update($data,$data['reply_id']);
        if($result) {
            flash()->success('发布成功');
        }else{
            flash()->error('发布失败');
        }
        return redirect()->back();
    }
}
