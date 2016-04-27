<?php

namespace App\Http\Controllers\Admin;

use App\WechatMenu;
use Illuminate\Http\Request;

use App\Http\Requests;


class WechatMenuController extends WechatBaseController
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
        //
        $menus = WechatMenu::where('wechat_id',$this->wechat->id)->where('level',1)->take(3)->get();
        return view('admin.wechat-menu.index',compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.wechat-menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\WechatMenuPostRequest $request)
    {
        //
        $data = $request->except('_token');
        $data['wechat_id'] = $this->wechat->id;
        if(isset($data['menu_id'])){
            $limit = 5;
            $level = '二';
            $count = WechatMenu::where('wechat_id',$this->wechat->id)
                                ->where('level',2)
                                ->where('menu_id',$data['menu_id'])
                                ->count();
        }else{
            $limit = 3;
            $level = '一';
            $count = WechatMenu::where('wechat_id',$this->wechat->id)
                                ->where('level',1)
                                ->where('menu_id',0)
                                ->count();
        }

        if($count>=$limit){
            flash()->error($level.'级菜单不能超过'.$limit.'个~');
        }else{
            $result = WechatMenu::create($data);
            if($result) {
                flash()->success('发布成功');
            }else{
                flash()->error('发布失败');
            }
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
        $wechat_menu = WechatMenu::find($id);
        return view('admin.wechat-menu.edit',compact('id','wechat_menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\WechatMenuPostRequest $request, $id)
    {
        //
        $data = $request->except('_token','_method','level');
        //dd($data);
        $result = WechatMenu::where('id',$id)->update($data);
        if($result) {
            flash()->success('更新成功');
        }else{
            flash()->error('更新失败');
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
        $result = WechatMenu::destroy($id);
        if($result){
            flash()->success('删除成功');
        }else{
            flash()->error('删除失败');
        }
        return redirect()->back();
    }

    /*
     * 子菜单
     * */
    public function subMenu($id)
    {
        $menus = WechatMenu::where('menu_id',$id)->get();
        $menu_id = $id;
        return view('admin.wechat-menu.sub_index',compact('menu_id','menus'));
    }

    public function subCreate($id)
    {
        $menu_id = $id;
        return view('admin.wechat-menu.create',compact('menu_id'));
    }

    /*
     * 推送菜单数据到微信服务器
     * */
    public function push()
    {

        $menus = WechatMenu::with('subs')
                            ->where('wechat_id',$this->wechat->id)
                            ->where('level',1)
                            ->where('menu_id',0)->get();

        //构建菜单
        $buttons = [];
        foreach($menus as $key=>$menu){

            if(count($menu->subs)>0){
                $buttons[$key] = [
                    "name"  =>  $menu->name,
                ];
                foreach($menu->subs as $k=>$m){
                    $buttons[$key]['sub_button'][$k] = [
                        'type'  =>  $m->type,
                        "name"  =>  $m->name,
                    ];

                    if($m->type=='view'){
                        $buttons[$key]['sub_button'][$k]['url'] = $m->content;
                    }elseif($m->type=='click'){
                        $buttons[$key]['sub_button'][$k]['key'] = $m->key;
                    }
                }
            }else{
                $buttons[$key] = [
                    'type'  =>  $menu->type,
                    "name"  =>  $menu->name,
                ];

                if($menu->type=='view'){
                    $buttons[$key]['url'] = $menu->content;
                }elseif($menu->type=='click'){

                    $buttons[$key]['key'] = $menu->key;
                }
            }
        }
        dd($buttons);
        $res = $this->wechatApp->menu->add($buttons);
        if($res->errcode==0){
            flash()->success('推送成功');
        }else{
            flash()->error('推送失败');
        }
        return redirect()->back();

    }
}
