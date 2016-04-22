@extends('layouts.admin.admin')

 @section('flash-message')
 @if (Session::has('flash_notification.message'))
     <div class="alert alert-{{ Session::get('flash_notification.level') }}">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

         {{ Session::get('flash_notification.message') }}
     </div>
 @endif
 @stop
@section('content')

<div class="row">
    <div class="col-sm-12">
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">编辑预约信息</h3>
                <div class="panel-options">
                    <a href="#" data-toggle="panel">
                        <span class="collapse-icon">&ndash;</span>
                        <span class="expand-icon">+</span>
                    </a>
                    <a href="#" data-toggle="remove">
                        &times;
                    </a>
                </div>
            </div>
            <div class="panel-body">
                
                {!! Form::open(['route'=>['admin.orderupkeep.update',$order->ou_id],'role'=>'form','class'=>'form-horizontal','method'=>'patch']) !!}

                    <div class="form-group @if($errors->first('ou_name')) has-error @endif">
                        <label class="col-sm-2 control-label" for="ou_name" >客户姓名</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="ou_name" id="ou_name" value="{{$order->ou_name}}" placeholder="@if($errors->first('ou_name')) {{$errors->first('ou_name')}} @else 客户姓名 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('ou_tel')) has-error @endif">
                        <label class="col-sm-2 control-label" for="ou_tel" >客户电话</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="ou_tel" id="ou_tel" value="{{$order->ou_tel}}" placeholder="@if($errors->first('ou_tel')) {{$errors->first('ou_tel')}} @else 客户电话 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('ou_carno')) has-error @endif">
                        <label class="col-sm-2 control-label" for="ou_carno" >车牌号</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="ou_carno" id="ou_carno" value="{{$order->ou_carno}}" placeholder="@if($errors->first('ou_carno')) {{$errors->first('ou_carno')}} @else 车牌号 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('ou_date')) has-error @endif">
                        <label class="col-sm-2 control-label" for="ou_date" >预约时间</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="ou_date" id="ou_date" value="{{$order->ou_date}}" placeholder="@if($errors->first('ou_date')) {{$errors->first('ou_date')}} @else 预约时间 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('ou_st_id')) has-error @endif">
                        <label class="col-sm-2 control-label" for="ou_st_id">专营店名称</label>

                        <div class="col-sm-10">
                            <select class="form-control" name="ou_st_id">
                                <option value="0">请选择</option>
                                @foreach($stations as $station)
                                    <option value="{{ $station->id }}"  @if($station->id== $order->ou_st_id) selected="selected" @endif>{{ $station->stationname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('ou_km')) has-error @endif">
                        <label class="col-sm-2 control-label" for="ou_km" >保养公里数</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" value="{{ $order->ou_km }}" name="ou_km" id="ou_km" placeholder="@if($errors->first('ou_km')) {{$errors->first('ou_km')}} @else 保养公里数 @endif">公里(Km)
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>

                        <div class="col-sm-10">

                            <button class="btn btn-danger">更新</button>

                        </div>
                    </div>

                {!! Form::close()!!}
                
            </div>
        </div>
        
    </div>
</div>
@stop
