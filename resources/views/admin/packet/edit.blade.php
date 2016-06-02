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

                    <div class="form-group @if($errors->first('packet_type')) has-error @endif">
                        <label class="col-sm-2 control-label">红包类型</label>

                        <div class="col-sm-3">
                            <div class="form-block">
                                <label>
                                    <input type="radio" name="packet_type" value="NORMAL" @if($item->packet_type=="NORMAL") checked @endif class="cbr cbr-primary">
                                    普通红包
                                </label>
                            </div>

                        </div>

                        <div class="col-sm-3">

                            <div class="form-block">
                                <label>
                                    <input type="radio" name="packet_type" value="GROUP" @if($item->packet_type=="GROUP") checked @endif class="cbr cbr-primary">
                                    裂变红包
                                </label>
                            </div>

                        </div>

                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">开始时间</label>

                        <div class="col-sm-3 @if($errors->first('start_at')) has-error @endif">
                            <input type="text" class="form-control form_datetime" value="{{ $item->start_at }}" name="start_at" id="start_at" placeholder="@if($errors->first('start_at')) {{$errors->first('start_at')}} @else 开始时间 @endif">
                        </div>

                        <label class="col-sm-2 control-label">结束时间</label>

                        <div class="col-sm-3 @if($errors->first('end_at')) has-error @endif">
                            <input type="text" class="form-control form_datetime" value="{{ $item->end_at }}" name="end_at" id="end_at" placeholder="@if($errors->first('end_at')) {{$errors->first('end_at')}} @else 结束时间 @endif">
                        </div>

                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('total_amount')) has-error @endif">
                        <label class="col-sm-2 control-label" for="total_amount" >红包金额</label>
                        
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $item->total_amount }}"  name="total_amount" id="total_amount" placeholder="@if($errors->first('total_amount')) {{$errors->first('total_amount')}} @else 红包金额(单位'分') @endif">
                        </div>
                    </div>
                    
                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('total_num')) has-error @endif">
                        <label class="col-sm-2 control-label" for="total_num" >发放人数</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $item->total_num }}"  name="total_num" id="total_num" placeholder="@if($errors->first('total_num')) {{$errors->first('total_num')}} @else 发放人数 @endif">
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

                    <div class="form-group @if($errors->first('times')) has-error @endif">
                        <label class="col-sm-2 control-label" for="times" >可用次数</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $item->times }}"  name="times" id="times" placeholder="@if($errors->first('times')) {{$errors->first('times')}} @else 可用次数 @endif">
                        </div>

                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('sign_key')) has-error @endif">
                        <label class="col-sm-2 control-label" for="sign_key" >签名密钥</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $item->sign_key }}"  name="sign_key" id="sign_key" placeholder="@if($errors->first('sign_key')) {{$errors->first('sign_key')}} @else 签名密钥(不可为中文) @endif">
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

                    <div class="form-group @if($errors->first('remark')) has-error @endif">
                        <label class="col-sm-2 control-label" for="remark" >接口地址</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $apiURL }}" readonly="readonly">
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
@section("style")
    {!! Html::style('style/assets/js/datetimepicker/css/bootstrap-datetimepicker.min.css') !!}
@stop
@section("script")

    {!! Html::script('style/assets/js/datetimepicker/js/bootstrap-datetimepicker.min.js') !!}
    {!! Html::script('style/assets/js/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js',['charset'=>'UTF-8']) !!}
    <script>
        var packet_type = $('input[name=packet_type]:checked').val();
        if (packet_type=="NORMAL"){
            $("#total_num").val(1).attr("readonly","readonly");

        }else if (packet_type=="GROUP") {
            $("#total_num").val('').attr("readonly",false);
        }
        //红包类型
        $('input[name=packet_type]').click(function(){
            var type = $(this).val();
            if (type=="NORMAL"){
                $("#total_num").val(1).attr("readonly","readonly");

            }else if (type=="GROUP") {
                $("#total_num").val('').attr("readonly",false);
            }

        });
        $(".form_datetime").datetimepicker({
            language:  'zh-CN',
            autoclose:true,
            format: 'yyyy-mm-dd hh:ii:ss'
        });
    </script>
@stop