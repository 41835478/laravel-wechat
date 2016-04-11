<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 7/17/15
 * Time: 5:24 PM
 */
 ?>

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
                    <strong>自动回复</strong>
                </li>
            </ol>

        </div>

    </div>
 @stop

 @section('right')

    <div class="col-md-9 mailbox-right">
        @include('ucenter.public.media.nav')

        @if(Request::route('type')=='news')
            @include('ucenter.public.media.news')
        @endif

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
    	<!-- Imported scripts on this page -->
     {{-- Html::script('style/assets/js/xenon-notes.js') --}}
     {!! Html::script('style/assets/js/jquery-validate/jquery.validate.min.js') !!}
     {!! Html::script('style/assets/js/jquery-ui/jquery-ui.min.js') !!}
     {!! Html::script('style/assets/js/dropzone/dropzone.min.js') !!}
     {!! Html::script('style/assets/js/tagsinput/bootstrap-tagsinput.min.js') !!}
 @stop
