<?php

namespace App\Http\Controllers\Admin;

use App\WechatPacket;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//红包
class PacketController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = WechatPacket::orderBy('id','desc')->paginate(20);
        return view('admin.packet.index',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.packet.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\PostPacketRequest $request)
    {
        $data = $request->except('_token','_method');

        $result = WechatPacket::create($data);

        if($result->id) {
            flash()->success('添加成功');
        }else{
            flash()->error('添加失败');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = WechatPacket::find($id);
        return view('admin.packet.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\PostPacketRequest $request, $id)
    {
        $data = $request->except('_token','_method');

        $result = WechatPacket::find($id)->update($data);

        if($result) {
            flash()->success('保存成功');
        }else{
            flash()->error('保存失败');
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
        $result = WechatPacket::destroy($id);
        if($result) {
            flash()->success('删除成功');
        }else{
            flash()->error('删除失败');
        }
        return redirect()->back();
    }
}
