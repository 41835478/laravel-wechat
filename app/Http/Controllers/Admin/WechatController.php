<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 6/18/15
 * Time: 3:17 PM
 */

namespace App\Http\Controllers\Admin;


use App\Repositories\WechatRepository;
use App\Wechat;
use Illuminate\Http\Request;

class WechatController extends BaseController{

    protected $public;

    public function __construct(WechatRepository $wechatRepository)
    {
        $this->public = $wechatRepository;
    }

    public function index()
    {
        $wechats = Wechat::paginate(20);
        return view('admin.public.index',compact('wechats'));
    }

    public function create()
    {
        return view('admin.public.create');
    }

    public function store(Request $request)
    {
        $result = $this->public->create($request->all());
        return $this->message($result);
    }

    public function edit($id)
    {
        $wechat = Wechat::find($id);
        return view('admin.public.edit',compact('wechat'));
    }

    public function update(Request $request,$id)
    {
        $result = $this->public->update($request->all(),$id);
        return $this->message($result);
    }

    public function destroy($id)
    {

    }

    public function message($result)
    {
        if($result->id) {
            flash()->success('操作成功');
        }else{
            flash()->error('操作失败');
        }
        return redirect()->back();
    }
}