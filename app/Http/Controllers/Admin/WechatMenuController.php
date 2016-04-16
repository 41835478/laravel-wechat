<?php

namespace App\Http\Controllers\Admin;

use App\WechatMenu;
use Illuminate\Http\Request;

use App\Http\Requests;
use Overtrue\Wechat\Menu;
use Overtrue\Wechat\MenuItem;


class WechatMenuController extends BaseController
{
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
    public function store(Request $request)
    {
        //
        $data = $request->except('_token');
        $data['wechat_id'] = $this->wechat->id;
        if(isset($data['menu_id'])){
            $limit = 5;
        }else{
            $limit = 3;
        }
        //dd($data);
        $count = WechatMenu::where('wechat_id',$this->wechat->id)->count();
        if($count>=$limit){
            flash()->error('一级菜单不能超过三个~');
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
    public function update(Request $request, $id)
    {
        //
        $data = $request->except('_token','_method');
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
        //
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
                            ->where('menu_id',0)->get();
        //
        $menuService = new Menu($this->wechat->app_id,$this->wechat->secret);

        $target = [];
        //构建菜单
        $content = '';
        foreach ($menus as $menu) {
            // 创建一个菜单项
            if($menu->type=='view') {
                $content = $menu->content;
            }else{
                $content = 'test';
            }

            $item = new MenuItem($menu->name, $menu->type, $content);

            // 子菜单
            if (!empty($menu->subs)) {
                $buttons = [];
                foreach ($menu->subs as $button) {
                    if($menu->type=='view') {
                        $content = $button->content;
                    }else{
                        $content = 'test';
                    }
                    $buttons[] = new MenuItem($button->name, $button->type, $content);
                }

                $item->buttons($buttons);
            }

            $target[] = $item;
        }
//        dd($target);
        $menuService->set($target); // 失败会抛出异常
        flash()->success('推送成功');
        return redirect()->back();

    }
}
