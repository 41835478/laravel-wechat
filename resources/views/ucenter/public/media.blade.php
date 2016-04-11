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
                    <a href="#"><i class="fa-home"></i>个人中心</a>
                </li>
                <li>
                    <a href="#">微信功能</a>
                </li>
                <li class="active">
                    <strong>素材管理</strong>
                </li>
            </ol>

        </div>

    </div>
 @stop

 @section('right')

    <div class="col-md-9 mailbox-right">
        <nav class="navbar navbar-inverse" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                    <span class="sr-only">Toggle navigation</span>
                    <i class="fa-bars"></i>
                </button>
                <a class="navbar-brand">素材管理</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="{{route('ucenter.wechat.media.type',[$wechatId,'news'])}}">图文消息</a>
                    </li>
                    <li>
                        <a href="#">图片库</a>
                    </li>
                    <li>
                        <a href="#">语音</a>
                    </li>
                    <li>
                        <a href="#">视频</a>
                    </li>
                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </nav>
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
