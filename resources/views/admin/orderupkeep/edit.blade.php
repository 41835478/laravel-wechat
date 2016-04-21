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
                <h3 class="panel-title">编辑车系</h3>
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
                
                {!! Form::open(['route'=>['admin.series.update',$sery->s_id],'role'=>'form','class'=>'form-horizontal','method'=>'patch']) !!}

                    <div class="form-group @if($errors->first('s_name')) has-error @endif">
                        <label class="col-sm-2 control-label" for="s_name" >车系</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="s_name" id="s_name" value="{{$sery->s_name}}" placeholder="@if($errors->first('s_name')) {{$errors->first('s_name')}} @else 用户名 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('sex')) has-error @endif">
                        <label class="col-sm-2 control-label">状态</label>

                        <div class="col-sm-10">

                            <p>
                            <label class="radio-inline">
                                <input type="radio" name="s_state" value="0" @if($sery->s_state==0) checked @endif>
                                    正常
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="s_state" value="1" @if($sery->s_state==1) checked @endif>
                                    归档
                            </label>
                            @if($errors->first('s_status')) {{$errors->first('s_status')}} @endif
                            </p>

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
