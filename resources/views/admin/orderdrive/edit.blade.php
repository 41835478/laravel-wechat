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

                {!! Form::open(['route'=>['admin.orderdrive.update',$order->od_id],'role'=>'form','class'=>'form-horizontal','method'=>'patch']) !!}

                    <div class="form-group @if($errors->first('od_name')) has-error @endif">
                        <label class="col-sm-2 control-label" for="od_name" >客户姓名</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="od_name" id="od_name" value="{{$order->od_name}}" placeholder="@if($errors->first('od_name')) {{$errors->first('od_name')}} @else 客户姓名 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('od_tel')) has-error @endif">
                        <label class="col-sm-2 control-label" for="od_tel" >客户电话</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="od_tel" id="ou_tel" value="{{$order->od_tel}}" placeholder="@if($errors->first('od_tel')) {{$errors->first('od_tel')}} @else 客户电话 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('od_st_id')) has-error @endif">
                        <label class="col-sm-2 control-label" for="od_st_id">专营店名称</label>

                        <div class="col-sm-10">
                            <select class="form-control" name="od_st_id">
                                <option value="0">请选择</option>
                                @foreach($shops as $shop)
                                    <option value="{{ $shop->id }}"  @if($shop->id== $order->od_st_id) selected="selected" @endif>{{ $shop->shopname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('od_s_id')) has-error @endif">
                        <label class="col-sm-2 control-label" for="od_s_id">车系名</label>

                        <div class="col-sm-10">
                            <select class="form-control" name="od_s_id">
                                <option value="0">请选择</option>
                                @foreach($series as $sery)
                                    <option value="{{ $sery->s_id }}"  @if($sery->s_id== $order->od_s_id) selected="selected" @endif>{{ $sery->s_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('od_ct_id')) has-error @endif">
                        <label class="col-sm-2 control-label" for="od_ct_id">车型名</label>

                        <div class="col-sm-10">
                            <select class="form-control" name="od_ct_id">
                                <option value="0">请选择</option>
                                @foreach($carmodels as $carmodel)
                                    <option value="{{ $carmodel->id }}"  @if($carmodel->id== $order->od_ct_id) selected="selected" @endif>{{ $carmodel->models }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group">
                        {!! Form::label('od_msg', '问题留言',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::textarea('od_msg',$order->od_msg,[
                                'class'=>'form-control',
                                'placeholder'=>'问题留言'
                            ]) !!}
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
