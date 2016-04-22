<?php

namespace App\Http\Controllers\Admin;

use App\CarModel;
use App\OrderDrive;
use App\Series;
use App\Shop;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderDriveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = OrderDrive::with('user','shop','series','carmodel')->paginate(20);
        return view('admin.orderdrive.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.orderdrive.create');
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
        $result = OrderDrive::firstOrCreate($data);
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
        $order = OrderDrive::with('user','shop','series','carmodel')->find($id);
        return view('admin.orderdrive.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = OrderDrive::with('user','shop','series','carmodel')->find($id);
        $shops = Shop::all();
        $series = Series::all();
        $carmodels = CarModel::all();
        return view('admin.orderdrive.edit',compact('order','shops','series','carmodels'));
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
        $res = OrderDrive::where('od_id',$id)->update( $data );
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
        $res = OrderDrive::destroy($id);
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
        $data['od_state'] = 1;
        $res = OrderDrive::where('od_id',$id)->update( $data );
        if($res){
            flash()->success('已归档');
        }else{
            flash()->error('归档失败');
        }
        return redirect()->back();
    }
}
