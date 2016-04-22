<?php

namespace App\Http\Controllers\Admin;

use App\OrderUpKeep;
use App\Station;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderUpKeepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = OrderUpKeep::with('user','station')->orderBy('ou_date','desc')->paginate(20);
        return view('admin.orderupkeep.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.orderupkeep.create');
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
        $result = OrderUpKeep::firstOrCreate($data);
        if($result){
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
        $order = OrderUpKeep::with('station')->find($id);
        return view('admin.orderupkeep.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = OrderUpKeep::find($id);
        $stations = Station::all();
        return view('admin.orderupkeep.edit',compact('order','stations'));
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
        //
        //dd($data);
        $res = OrderUpKeep::where('ou_id',$id)->update( $data );
        if($res){
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
        $res = OrderUpKeep::destroy($id);
        if($res){
            flash()->success('更新成功');
        }else{
            flash()->error('更新失败');
        }
        return redirect()->back();
    }
    /*
     * 归档
     * */
    public function archive($id)
    {
        //dd($data);
        $data['ou_state'] = 1;
        $res = OrderUpKeep::where('ou_id',$id)->update( $data );
        if($res){
            flash()->success('已归档');
        }else{
            flash()->error('归档失败');
        }
        return redirect()->back();
    }
}
