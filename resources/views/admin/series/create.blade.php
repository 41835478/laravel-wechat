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
                <h3 class="panel-title">基本信息</h3>
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
                
                {!! Form::open(['route'=>['admin.series.store'],'role'=>'form','class'=>'form-horizontal','method'=>'post']) !!}

                    <div class="form-group @if($errors->first('s_name')) has-error @endif">
                        <label class="col-sm-2 control-label" for="s_name" >车系</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="s_name" id="s_name" placeholder="@if($errors->first('s_name')) {{$errors->first('s_name')}} @else 车系名称 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('s_state')) has-error @endif">
                        <label class="col-sm-2 control-label">排序</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="s_state" id="s_state" placeholder="@if($errors->first('s_state')) {{$errors->first('s_state')}} @else 序号 @endif">
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
