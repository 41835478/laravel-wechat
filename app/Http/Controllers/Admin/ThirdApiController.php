<?php

namespace App\Http\Controllers\Admin;

use App\WechatThirdApi;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ThirdApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apis = WechatThirdApi::paginate(20);
        return view('admin.wechat-third-api.index',compact('apis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.wechat-third-api.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token','_method');
        $has = WechatThirdApi::where('api_url',$data['api_url'])->first();
        if($has){
            flash()->error('该接口已存在');
        }else{
            $create = WechatThirdApi::create($data);
            if($create) {
                flash()->success('添加成功');
            }else{
                flash()->error('添加失败');
            }
            return redirect()->back();
        }
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
        $api = WechatThirdApi::find($id);
        return view('admin.wechat-third-api.edit',compact('api'));
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
        $data = $request->except('_token','_method');

        $has = WechatThirdApi::where('api_url',$data['api_url'])->where('id','!=',$id)->first();
        if($has){
            flash()->error('该接口已存在');
        }else{
            $api = WechatThirdApi::find($id)->update($data);
            if($api) {
                flash()->success('修改成功');
            }else{
                flash()->error('修改失败');
            }
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $api = WechatThirdApi::destroy($id);
        if($api) {
            flash()->success('删除成功');
        }else{
            flash()->error('删除失败');
        }
        return redirect()->back();
    }
}
