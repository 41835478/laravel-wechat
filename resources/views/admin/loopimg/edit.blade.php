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
                    <h3 class="panel-title">编辑图片</h3>
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

                    {!! Form::open(['route'=>['admin.loopimg.update',$loopimg->l_id],'role'=>'form','class'=>'form-horizontal','method'=>'patch']) !!}

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('l_img')) has-error @endif">
                        <label class="col-sm-2 control-label" for="l_img">封面</label>

                        <div class="col-sm-8">
                            <input type="text" name="l_img" class="form-control" value="{{ $loopimg->l_img }}" id="pic_url" placeholder="@if($errors->first('l_img')) {{$errors->first('l_img')}} @else 图片地址 @endif">
                        </div>
                        <div class="col-sm-1">
                            <a href="javascript:;" onclick="jQuery('#upload').modal('show');" class="btn btn-primary btn-single btn-sm">上传图片</a>
                        </div>

                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="photo">预览</label>

                        <div class="col-sm-10" id="preview_pic">
                            <img src="{{ url($loopimg->l_img) }}" width="200"/>
                        </div>


                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('l_asc')) has-error @endif">
                        <label class="col-sm-2 control-label" for="l_asc" >排序</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $loopimg->l_asc }}" name="l_asc" id="l_asc" placeholder="@if($errors->first('l_asc')) {{$errors->first('l_asc')}} @else 排序 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('l_address')) has-error @endif">
                        <label class="col-sm-2 control-label" for="l_address" >地址</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="l_address" value="{{$loopimg->l_address}}" id="l_address" placeholder="@if($errors->first('l_address')) {{$errors->first('l_address')}} @else 地址 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('l_state')) has-error @endif">
                        <label class="col-sm-2 control-label">状态</label>

                        <div class="col-sm-10">

                            <p>
                                <label class="radio-inline">
                                    <input type="radio" name="l_state" value="0" @if($loopimg->l_state==0) checked @endif>
                                    正常
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="l_state" value="1" @if($loopimg->l_state==1) checked @endif>
                                    归档
                                </label>
                                @if($errors->first('l_state')) {{$errors->first('l_state')}} @endif
                            </p>

                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>

                        <div class="col-sm-10">

                            <button class="btn btn-danger">保存</button>

                        </div>
                    </div>

                    {!! Form::close()!!}

                </div>
            </div>

        </div>
    </div>
@stop
@section('other')
    @include('upload.single_file',['type'=>'car_model'])
@stop
