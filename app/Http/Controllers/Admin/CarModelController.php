<?php

namespace App\Http\Controllers\Admin;

use App\CarModel;
use App\Series;
use DebugBar\DebugBar;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CarModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $carmodels = CarModel::with('series')->paginate(20);
        return view('admin.carmodel.index',compact('carmodels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $series = Series::all();
        return view('admin.carmodel.create',compact('series'));
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
        $data = $request->except('_token','_method');
        $data['insert_times'] = date('Y-m-d H:i:s',time());
        $result = CarModel::firstOrCreate($data);
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
        //
        $series = Series::all();
        $carmodel = CarModel::with('series')->find($id);
        return view('admin.carmodel.edit',compact('carmodel','series'));
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
        //
        $data['insert_times'] = date('Y-m-d H:i:s',time());
        //dd($data);
        $res = CarModel::where('id',$id)->update( $data );
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
        //
        $res = CarModel::destroy($id);
        if($res){
            flash()->success('更新成功');
        }else{
            flash()->error('更新失败');
        }
        return redirect()->back();
    }
}
