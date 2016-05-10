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
            </div>
            <div class="panel-body">
                
                {!! Form::open(['route'=>['admin.wechat-packet.update',$item->id],'role'=>'form','class'=>'form-horizontal','method'=>'patch']) !!}

                    <div class="form-group @if($errors->first('act_name')) has-error @endif">
                        <label class="col-sm-2 control-label" for="act_name" >活动名称</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $item->act_name }}" name="act_name" id="act_name" placeholder="@if($errors->first('act_name')) {{$errors->first('act_name')}} @else 活动名称 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('re_openid')) has-error @endif">
                        <label class="col-sm-2 control-label" for="re_openid" >种子用户</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $item->re_openid }}" name="re_openid" id="re_openid" placeholder="@if($errors->first('re_openid')) {{$errors->first('re_openid')}} @else 种子用户openid,可留空 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('total_amount')) has-error @endif">
                        <label class="col-sm-2 control-label" for="total_amount" >总金额</label>
                        
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $item->total_amount }}"  name="total_amount" id="total_amount" placeholder="@if($errors->first('total_amount')) {{$errors->first('total_amount')}} @else 总金额(单位'分') @endif">
                        </div>
                    </div>
                    
                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('total_num')) has-error @endif">
                        <label class="col-sm-2 control-label" for="total_num" >总人数</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $item->total_num }}"  name="total_num" id="total_num" placeholder="@if($errors->first('total_num')) {{$errors->first('total_num')}} @else 总人数 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('wishing')) has-error @endif">
                        <label class="col-sm-2 control-label" for="wishing" >祝福语</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $item->wishing }}"  name="wishing" id="wishing" placeholder="@if($errors->first('wishing')) {{$errors->first('wishing')}} @else 祝福语 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('remark')) has-error @endif">
                        <label class="col-sm-2 control-label" for="remark" >备注</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $item->remark }}"  name="remark" id="remark" placeholder="@if($errors->first('remark')) {{$errors->first('remark')}} @else 备注 @endif">
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
