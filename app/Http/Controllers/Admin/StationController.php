<?php

namespace App\Http\Controllers\Admin;

use App\Station;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Station::paginate(20);
        return view('admin.station.index',compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.station.create');
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
        $result = Station::firstOrCreate($data);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shop = Station::find($id);
        return view('admin.station.edit',compact('shop'));
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
        $res = Station::where('st_id',$id)->update( $data );
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
        $res = Station::destroy($id);
        if($res){
            flash()->success('更新成功');
        }else{
            flash()->error('更新失败');
        }
        return redirect()->back();
    }
}
