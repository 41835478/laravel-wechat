<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 15/3/30
 * Time: 上午10:24
 */
 ?>
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
                <h3 class="panel-title">公众号配置</h3>
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

                {!! Form::open(['route'=>['admin.public.update',$wechat->id],'role'=>'form','class'=>'form-horizontal',]) !!}
                    {!! Form::hidden('user_id',Auth::id()) !!}
                    <div class="form-group @if($errors->first('public_name')) has-error @endif">
                        <label class="col-sm-2 control-label" for="public_name">公众号名称</label>

                        <div class="col-sm-10">
                            <input type="text" name="public_name" class="form-control" id="public_name" value="{{$wechat->public_name}}" placeholder="@if($errors->first('public_name')) {{$errors->first('public_name')}} @else 公众号名称 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('original_id')) has-error @endif">
                        <label class="col-sm-2 control-label" for="original_id">原始ID</label>

                        <div class="col-sm-10">
                            <input type="text" name="original_id" class="form-control" id="original_id"  value="{{$wechat->original_id}}" placeholder="@if($errors->first('original_id')) {{$errors->first('original_id')}} @else 原始ID @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('wechat_account')) has-error @endif">
                        <label class="col-sm-2 control-label" for="wechat_account">微信号</label>

                        <div class="col-sm-10">
                            <input type="text" name="wechat_account" class="form-control" id="wechat_account" value="{{$wechat->wechat_account}}" placeholder="@if($errors->first('wechat_account')) {{$errors->first('wechat_account')}} @else 微信号 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('avatar')) has-error @endif">
                        <label class="col-sm-2 control-label" for="avatar">头像地址</label>

                        <div class="col-sm-10">
                            <input type="text" name="avatar" class="form-control" id="avatar" value="{{$wechat->avatar}}" placeholder="@if($errors->first('avatar')) {{$errors->first('avatar')}} @else 头像地址 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">账号类型</label>

                        <div class="col-sm-3">
                            <div class="form-block">
                                <label>
                                    <input type="radio" name="wechat_type" value="subscribe" @if($wechat->wechat_type=='subscribe') checked @endif class="cbr cbr-primary">
                                    订阅号
                                </label>
                            </div>

                        </div>

                        <div class="col-sm-3">

                            <div class="form-block">
                                <label>
                                    <input type="radio" name="wechat_type" value="service" @if($wechat->wechat_type=='service') checked @endif class="cbr cbr-primary">
                                    服务号
                                </label>
                            </div>

                        </div>

                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('app_id')) has-error @endif">
                        <label class="col-sm-2 control-label" for="app_id">AppId</label>

                        <div class="col-sm-10">
                            <input type="text" name="app_id" class="form-control" id="app_id" value="{{$wechat->app_id}}" placeholder="@if($errors->first('app_id')) {{$errors->first('app_id')}} @else AppId @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('secret')) has-error @endif">
                        <label class="col-sm-2 control-label" for="secret">Secret</label>

                        <div class="col-sm-10">
                            <input type="text" name="secret" class="form-control" id="secret" value="{{$wechat->secret}}" placeholder="@if($errors->first('secret')) {{$errors->first('secret')}} @else Secret @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('encoding_aes_key')) has-error @endif">
                        <label class="col-sm-2 control-label" for="encoding_aes_key">EncodingAESKey</label>

                        <div class="col-sm-10">
                            <input type="text" name="encoding_aes_key" class="form-control" value="{{$wechat->encoding_aes_key}}" id="encoding_aes_key" value="encoding_aes_key" placeholder="@if($errors->first('encoding_aes_key')) {{$errors->first('encoding_aes_key')}} @else EncodingAESKey @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('wechat_token')) has-error @endif">
                        <label class="col-sm-2 control-label" for="wechat_token">Token</label>

                        <div class="col-sm-10">
                            <input type="text" name="wechat_token" class="form-control" id="wechat_token" value="{{$wechat->wechat_token}}" placeholder="@if($errors->first('wechat_token')) {{$errors->first('wechat_token')}} @else Token @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('mch_id')) has-error @endif">
                        <label class="col-sm-2 control-label" for="mch_id">商户ID</label>

                        <div class="col-sm-10">
                            <input type="text" name="mch_id" class="form-control"
                                   id="mch_id" value="{{$wechat->mch_id}}"
                                   placeholder="@if($errors->first('mch_id'))
                                   {{$errors->first('mch_id')}} @else 商户ID @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('send_name')) has-error @endif">
                        <label class="col-sm-2 control-label" for="send_name">商户名</label>

                        <div class="col-sm-10">
                            <input type="text" name="send_name" class="form-control"
                                   id="send_name" value="{{$wechat->send_name}}"
                                   placeholder="@if($errors->first('send_name')) {{$errors->first('send_name')}} @else 商户名 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('key')) has-error @endif">
                        <label class="col-sm-2 control-label" for="key">商户密钥</label>

                        <div class="col-sm-10">
                            <input type="text" name="key"
                                   class="form-control" id="key"
                                   value="{{$wechat->key}}" placeholder="@if($errors->first('key'))
                                    {{$errors->first('key')}} @else 商户密钥 @endif">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('cert_path')) has-error @endif">
                        <label class="col-sm-2 control-label" for="cert_path">cert_path</label>

                        <div class="col-sm-10">
                            <input type="text" name="cert_path" class="form-control" id="cert_path"
                                   value="{{$wechat->cert_path}}"
                                   placeholder="@if($errors->first('cert_path'))
                                   {{$errors->first('cert_path')}} @else Cert_path @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('key_path')) has-error @endif">
                        <label class="col-sm-2 control-label" for="key_path">key_path</label>

                        <div class="col-sm-10">
                            <input type="text" name="key_path" class="form-control" id="key_path"
                                   value="{{$wechat->key_path}}"
                                   placeholder="@if($errors->first('key_path'))
                                   {{$errors->first('key_path')}} @else Key_path @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('wechat_token')) has-error @endif">
                        <label class="col-sm-2 control-label" for="interface_url">接口地址</label>

                        <div class="col-sm-10">
                            <input type="text" name="interface_url" class="form-control" id="interface_url" value="{{ url('wechat/auth/'.$wechat->id) }}">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>

                        <div class="col-sm-10">

                            <button class="btn btn-danger">确认修改</button>

                        </div>
                    </div>

                {!! Form::close() !!}

            </div>
        </div>

    </div>
</div>

 @stop

 @section('style')
     {!! Html::style('style/assets/js/datatables/dataTables.bootstrap.css') !!}
     {!! Html::style('style/assets/js/daterangepicker/daterangepicker-bs3.css') !!}
     {!! Html::style('style/assets/js/dropzone/css/dropzone.css') !!}
 @stop
 @section('script')

    {!! Html::script('style/assets/js/moment.min.js') !!}
    {!! Html::script('style/assets/js/daterangepicker/daterangepicker.js') !!}
    {!! Html::script('style/assets/js/datepicker/bootstrap-datepicker.js') !!}
    {!! Html::script('style/assets/js/timepicker/bootstrap-timepicker.min.js') !!}

    {!! Html::script('style/assets/js/colorpicker/bootstrap-colorpicker.min.js') !!}
    {!! Html::script('style/assets/js/select2/select2.min.js') !!}
    {!! Html::script('style/assets/js/jquery-ui/jquery-ui.min.js') !!}
    {!! Html::script('style/assets/js/selectboxit/jquery.selectBoxIt.min.js') !!}
    {!! Html::script('style/assets/js/tagsinput/bootstrap-tagsinput.min.js') !!}
    {!! Html::script('style/assets/js/typeahead.bundle.js') !!}
    {!! Html::script('style/assets/js/multiselect/js/jquery.multi-select.js') !!}

 @stop
