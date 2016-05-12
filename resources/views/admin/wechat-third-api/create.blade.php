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
                <h3 class="panel-title">添加第三方接口</h3>
            </div>
            <div class="panel-body">
                
                {!! Form::open(['route'=>'admin.wechat-thirdApi.store','role'=>'form','class'=>'form-horizontal',]) !!}
                    
                    <div class="form-group @if($errors->first('api_url')) has-error @endif">
                        <label class="col-sm-2 control-label" for="api_url" >接口地址</label>
                        
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ old('api_url') }}" name="api_url" id="api_url" placeholder="@if($errors->first('api_url')) {{$errors->first('api_url')}} @else 接口地址 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('token')) has-error @endif">
                        <label class="col-sm-2 control-label" for="token" >Token</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ old('token') }}" name="token" id="token" placeholder="@if($errors->first('token')) {{$errors->first('token')}} @else 密钥 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('keyword')) has-error @endif">
                        <label class="col-sm-2 control-label" for="keyword" >关键词</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ old('keyword') }}" name="keyword" id="keyword" placeholder="@if($errors->first('keyword')) {{$errors->first('keyword')}} @else 关键词 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="remark">备注</label>
                        
                        <div class="col-sm-10">
                            <textarea class="form-control" cols="5" value="{{ old('keyword') }}" name="remark" id="remark" placeholder="备注"></textarea>
                        </div>
                    </div>

                    <div class="form-group-separator"></div>
                    
                    <div class="form-group @if($errors->first('status')) has-error @endif">
                        <label class="col-sm-2 control-label">状态</label>
                        
                        <div class="col-sm-10">
                            
                            <p>
                            <label class="radio-inline">
                                <input type="radio" name="status" value="0">
                                    不可用
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="status" value="1" checked>
                                    可用
                            </label>
                            @if($errors->first('status')) {{$errors->first('status')}} @endif
                            </p>
                            
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        
                        <div class="col-sm-10">
                            
                            <button class="btn btn-danger">添加</button>
                            
                        </div>
                    </div>
                    
                {!! Form::close()!!}
                
            </div>
        </div>
        
    </div>
</div>
@stop
