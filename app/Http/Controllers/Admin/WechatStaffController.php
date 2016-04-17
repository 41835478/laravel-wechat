<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WechatStaffController extends WechatBaseController
{
    public $staff;

    public function __construct()
    {
        parent::__construct();

        $this->staff = $this->wechatApp->staff;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd($this->wechatApp->staff);
        //
        $staffs = $this->staff->lists();
        //dd($staffs->kf_list);
        return view('admin.wechat-staff.index',compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.wechat-staff.create');
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
        $data = $request->all();
        //dd($data);
        $result = $this->staff->create($data['kf_account'],$data['nickname'],$data['password']);
        //dd($result);
        if($result->errcode==0){
            flash()->success('添加客服成功');
        }else{
            flash()->error($result->errmsg);
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
        //
        $staffs = $this->staff->lists();
        $staff = '';
        foreach($staffs->kf_list as $item){
            if($item['kf_id']==$id){
                $staff = $item;
            }
        }

        return view('admin.wechat-staff.edit',compact('staff'));
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
        $kf_account = $request->input('kf_account');
        $nickname   = $request->input('nickname');
        $password   = $request->input('password');
        //dd($request->all());
        $result = $this->staff->update($kf_account, $nickname, $password);
        if($result->errcode==0){
            flash()->success('添加客服成功');
        }else{
            flash()->error($result->errmsg);
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
        $result = $this->staff->delete($id);
        if($result->errcode==0){
            flash()->success('删除成功');
        }else{
            flash()->error($result->errmsg);
        }
        return redirect()->back();
    }

    public function inviteCreate(Request $request)
    {
        $kf_account = $request->input('kf_account');
        return view('admin.wechat-staff.inviteCreate',compact('kf_account'));
    }

    public function inviteStore(Request $request)
    {
        $kf_account = $request->input('kf_account');
        $invite_wx  = $request->input('invite_wx');
        $result = $this->staff->invite($kf_account,$invite_wx);

        if($result->errcode==0){
            $result = ['status'=>200,'msg'=>'邀请成功!'];
        }else{
            $result = ['status'=>201,'msg'=>'邀请失败!'];
        }
        return response()->json($result);
    }
}
