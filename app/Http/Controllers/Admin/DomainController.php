<?php

namespace App\Http\Controllers\Admin;

use App\WechatDomain;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DomainController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $domains = WechatDomain::where('wechat_id',$this->wechat->id)->paginate(20);
        return view('admin.wechat-domain.index',compact('domains'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.wechat-domain.create');
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
        $data = $request->except('_token');
        $data['wechat_id'] = $this->wechat->id;
        //dd($data);
        $result = WechatDomain::create($data);
        if($result){
            flash()->success('发布成功');
        }else{
            flash()->error('发布失败');
        }
        return redirect()->back();

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
        $domain = WechatDomain::find($id);
        return view('admin.wechat-domain.show',compact('domain'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $domain = WechatDomain::find($id);
        return view('admin.wechat-domain.edit',compact('domain'));
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
        $data = $request->except('_token');
        $result = WechatDomain::find($id)->update($data);
        if($result){
            flash()->success('发布成功');
        }else{
            flash()->error('发布失败');
        }
        return redirect()->back();
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
        $result = WechatDomain::destroy($id);
        if($result){
            flash()->success('删除成功');
        }else{
            flash()->error('删除失败');
        }
        return redirect()->back();
    }
}
