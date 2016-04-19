<?php

namespace App\Http\Controllers\Admin;

use App\KeywordRule;
use App\Reply;
use Illuminate\Http\Request;
use App\Http\Requests;

class WechatRuleController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //查询规则
        $rules = KeywordRule::paginate(10);


        return view('admin.reply.ruleIndex',compact('rules'));
    }

    public function create()
    {
        return view('admin.reply.create-rule');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createOrEdit(Request $request)
    {
        //
        $rule_id = $request->input('rule_id');
        $rule = KeywordRule::find($rule_id);
        return view('admin.reply.ruleCreate',compact('rule'));
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
        $rule_name = $request->input('rule_name');
        $rule_id = $request->input('id');
        if($rule_id){
            $rule = KeywordRule::where('id',$rule_id)->update([
                                    'rule_name' => $rule_name
                                    ]);
            if($rule){
                $result = ['status'=>200,'msg'=>'修改成功!'];
            }else{
                $result = ['status'=>201,'msg'=>'修改失败!'];
            }
        }else{
            $rule = KeywordRule::create([
                'rule_name' => $rule_name,
                'wechat_id' => $this->wechat->id
            ]);
            if($rule){
                $result = ['status'=>200,'msg'=>'添加成功!'];
            }else{
                $result = ['status'=>201,'msg'=>'添加失败!'];
            }
        }

        return response()->json($result);
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
        $reply = Reply::with('keywords','replies')->find($id);
        return view('admin.reply.edit-rule',compact('reply'));
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
}
