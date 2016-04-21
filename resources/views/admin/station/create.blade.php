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
                    <h3 class="panel-title">维修站信息</h3>
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

                    {!! Form::open(['route'=>['admin.station.store'],'role'=>'form','class'=>'form-horizontal']) !!}

                    <div class="form-group @if($errors->first('stationname')) has-error @endif">
                        <label class="col-sm-2 control-label" for="stationname" >专营店名称</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="stationname" id="stationname" placeholder="@if($errors->first('stationname')) {{$errors->first('stationname')}} @else 专营店名称 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('address')) has-error @endif">
                        <label class="col-sm-2 control-label" for="address" >专营店地址</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="address" id="address" placeholder="@if($errors->first('address')) {{$errors->first('address')}} @else 专营店地址 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('tel1')) has-error @endif">
                        <label class="col-sm-2 control-label" for="tel1" >紧急救缓</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="tel1" id="tel1" placeholder="@if($errors->first('tel1')) {{$errors->first('tel1')}} @else 紧急救缓 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('tel2')) has-error @endif">
                        <label class="col-sm-2 control-label" for="tel2" >销售热线</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="tel2" id="tel2" placeholder="@if($errors->first('tel2')) {{$errors->first('tel2')}} @else 销售热线 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('state')) has-error @endif">
                        <label class="col-sm-2 control-label">专营店状态</label>

                        <div class="col-sm-10">

                            <p>
                                <label class="radio-inline">
                                    <input type="radio" name="state" value="0" checked>
                                    正常
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="state" value="1">
                                    归档
                                </label>
                                @if($errors->first('state')) {{$errors->first('state')}} @endif
                            </p>

                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('x')) has-error @endif">
                        <label class="col-sm-2 control-label" for="x" >4S店定位</label>

                        <div class="col-sm-1 control-label">
                            X:
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="x" id="x" placeholder="@if($errors->first('x')) {{$errors->first('x')}} @else X坐标 @endif">
                        </div>
                        <div class="col-sm-1 control-label">
                            Y:
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="y" id="y" placeholder="@if($errors->first('y')) {{$errors->first('y')}} @else Y坐标 @endif">
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
