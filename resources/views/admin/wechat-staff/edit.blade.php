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
                <h3 class="panel-title">编辑客服</h3>
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
                
                {!! Form::open(['route'=>['admin.wechat-staff.update',$staff['kf_id']],'role'=>'form','class'=>'form-horizontal','method'=>'patch']) !!}
                    
                    <div class="form-group @if($errors->first('kf_account')) has-error @endif">
                        <label class="col-sm-2 control-label" for="kf_account" >客服账号</label>
                        
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $staff['kf_account'] }}" name="kf_account" id="kf_account" placeholder="@if($errors->first('kf_account')) {{$errors->first('kf_account')}} @else 客服账号 @endif" readonly="readonly">
                        </div>
                    </div>
                    
                    <div class="form-group-separator"></div>
                    
                    <div class="form-group @if($errors->first('nickname')) has-error @endif">
                        <label class="col-sm-2 control-label" for="nickname">昵称</label>
                        
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $staff['kf_nick'] }}" name="nickname" id="nickname" placeholder="@if($errors->first('nickname')) {{$errors->first('nickname')}} @else 客服昵称 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('password')) has-error @endif" style="display: none">
                        <label class="col-sm-2 control-label" for="password">密码</label>

                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" id="password" placeholder="@if($errors->first('password')) {{$errors->first('password')}} @else 密码 @endif">
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
