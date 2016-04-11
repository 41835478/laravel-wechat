<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 15/3/30
 * Time: 上午10:24
 */
 ?>
 @extends('layouts.ucenter.ucenter')

@section('page-title')
    <div class="page-title">

        <div class="title-env">
            <h1 class="title">微信功能</h1>
            <p class="description">微信基本功能</p>
        </div>

        <div class="breadcrumb-env">

            <ol class="breadcrumb bc-1">
                <li>
                    <a href="dashboard-1.html"><i class="fa-home"></i>个人中心</a>
                </li>
                <li>
                    <a href="extra-gallery.html">微信功能</a>
                </li>
                <li class="active">
                    <strong>添加公众号</strong>
                </li>
            </ol>

        </div>

    </div>
@stop

 @section('right')
 <!-- Inbox emails -->
     <div class="col-sm-9 mailbox-right">

         <div class="panel panel-default">
             <div class="panel-heading">
                 <h3 class="panel-title">内容信息</h3>
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

                 {!! Form::open(['route'=>'ucenter.wechat.store','role'=>'form','class'=>'form-horizontal',]) !!}

                     <div class="form-group-separator"></div>

                     <div class="form-group @if($errors->first('public_name')) has-error @endif">
                         <label class="col-sm-2 control-label" for="title">公众号名称</label>

                         <div class="col-sm-10">
                             <input type="text" name="public_name" class="form-control" id="public_name" placeholder="@if($errors->first('public_name')) {{$errors->first('public_name')}} @else 公众号名称 @endif">
                         </div>
                     </div>

                     <div class="form-group-separator"></div>

                     <div class="form-group @if($errors->first('original_id')) has-error @endif">
                         <label class="col-sm-2 control-label" for="original_id">原始ID</label>

                         <div class="col-sm-10">
                             <input type="text" name="original_id" class="form-control" id="original_id" placeholder="@if($errors->first('original_id')) {{$errors->first('original_id')}} @else 公众号原始ID @endif">
                         </div>
                     </div>

                     <div class="form-group-separator"></div>

                     <div class="form-group @if($errors->first('wechat_account')) has-error @endif">
                         <label class="col-sm-2 control-label" for="wechat_account">微信号</label>

                         <div class="col-sm-10">
                             <input type="text" name="wechat_account" class="form-control" id="wechat_account" placeholder="@if($errors->first('wechat_account')) {{$errors->first('wechat_account')}} @else 微信号 @endif">
                         </div>
                     </div>

                     <div class="form-group-separator"></div>

                     <div class="form-group @if($errors->first('avatar')) has-error @endif">
                         <label class="col-sm-2 control-label" for="avatar">头像地址</label>

                         <div class="col-sm-10">
                             <input type="text" name="avatar" class="form-control"  id="avatar" placeholder="@if($errors->first('avatar')) {{$errors->first('photo')}} @else 头像地址 @endif">
                         </div>

                     </div>

                     <div class="form-group-separator"></div>

                     <div class="form-group @if($errors->first('avatar')) has-error @endif">
                         <label class="col-sm-2 control-label">账号类型</label>

                         <div class="col-sm-3">

                             <div class="form-block">
                                 <label>
                                     <input type="radio" name="wechat_type" value="1" class="cbr cbr-secondary">
                                     订阅号
                                 </label>
                             </div>

                         </div>

                         <div class="col-sm-3">

                             <div class="form-block">
                                 <label>
                                     <input type="radio" name="wechat_type" value="2" class="cbr cbr-secondary">
                                     认证订阅号
                                 </label>
                             </div>

                         </div>

                         <div class="col-sm-3">

                             <div class="form-block">
                                 <label>
                                     <input type="radio" name="wechat_type" value="3" class="cbr cbr-secondary">
                                     服务号
                                 </label>
                             </div>

                         </div>

                     </div>

                     <div class="form-group-separator"></div>

                     <div class="form-group @if($errors->first('app_id')) has-error @endif">
                         <label class="col-sm-2 control-label" for="app_id">AppId</label>

                         <div class="col-sm-10">
                             <input type="text" name="app_id" class="form-control" id="app_id" placeholder="@if($errors->first('app_id')) {{$errors->first('app_id')}} @else AppId @endif">
                         </div>
                     </div>

                     <div class="form-group-separator"></div>

                     <div class="form-group @if($errors->first('secret')) has-error @endif">
                         <label class="col-sm-2 control-label" for="secret">Secret</label>

                         <div class="col-sm-10">
                             <input type="text" name="secret" class="form-control" id="secret" placeholder="@if($errors->first('secret')) {{$errors->first('secret')}} @else Secret @endif">
                         </div>
                     </div>

                     <div class="form-group-separator"></div>

                     <div class="form-group @if($errors->first('encoding_aes_key')) has-error @endif">
                         <label class="col-sm-2 control-label" for="encoding_aes_key">EncodingAESKey</label>

                         <div class="col-sm-10">
                             <input type="text" name="encoding_aes_key" class="form-control" id="encoding_aes_key" placeholder="@if($errors->first('encoding_aes_key')) {{$errors->first('encoding_aes_key')}} @else EncodingAESKey @endif">
                         </div>
                     </div>

                     <div class="form-group-separator"></div>

                     <div class="form-group @if($errors->first('wechat_token')) has-error @endif">
                         <label class="col-sm-2 control-label" for="wechat_token">Token</label>

                         <div class="col-sm-10">
                             <input type="text" name="wechat_token" class="form-control" id="wechat_token" placeholder="@if($errors->first('wechat_token')) {{$errors->first('wechat_token')}} @else Token @endif">
                         </div>
                     </div>

                     <div class="form-group-separator"></div>

                     <div class="form-group @if($errors->first('interface_url')) has-error @endif">
                         <label class="col-sm-2 control-label" for="title">接口地址</label>

                         <div class="col-sm-10">
                             <input type="text" name="interface_url" class="form-control" id="interface_url" placeholder="@if($errors->first('interface_url')) {{$errors->first('interface_url')}} @else 接口地址 @endif">
                         </div>
                     </div>

                     <div class="form-group-separator"></div>

                     <div class="form-group">
                         <label class="col-sm-1 control-label"></label>

                         <div class="col-sm-11">

                             <button class="btn btn-danger">添加</button>

                         </div>
                     </div>

                 {!! Form::close() !!}

             </div>
         </div>
     </div>
 @stop

 @section('left')
    @include('ucenter.left')
 @stop

 @section('style')
     {!! Html::style('style/assets/js/datatables/dataTables.bootstrap.css') !!}

     {!! Html::style('style/assets/js/dropzone/css/dropzone.css') !!}
 @stop
 @section('script')

          {!! Html::script('style/assets/js/dropzone/dropzone.min.js') !!}

 @stop
