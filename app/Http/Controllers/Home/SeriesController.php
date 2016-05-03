<?php

namespace App\Http\Controllers\Home;

use App\LoopImg;
use App\Series;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SeriesController extends BaseController{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $series = Series::with(['carmodel'=>function($query){
            $query->where('images', '<>', '')->orderBy('id','desc');
        }])->orderBy('s_state')->get();

       // dd($series[0]->carmodel[0]->price);
        $loopimgs = LoopImg::where('l_state',0)->get();
        return view('home.series.index',compact('series','loopimgs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $series = Series::with('carmodel.carImages')->find($id);

        //dd($series->carmodel);
        return view('home.series.show',compact('series'));
    }

}
