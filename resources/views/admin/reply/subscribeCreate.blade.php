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
             <a class="btn btn-primary" href="{{ route('admin.wechat-reply.subscribeCreate') }}">被添加自动回复</a>
             <a class="btn btn-primary" href="{{ route('admin.wechat-reply.rule') }}">关键词自动回复</a>
         </div>
     </div>
 </div>
<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">被动添加自动回复</h3>
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

                {!! Form::open(['route'=>'admin.wechat-reply.subscribeStore','role'=>'form','class'=>'form-horizontal',]) !!}
                    {!! Form::hidden('wechat_id',$wechat->id) !!}
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="app_id">回复内容</label>
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control" name="content" placeholder="内容" ></textarea>
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>

                        <div class="col-sm-10">

                            <button class="btn btn-danger">添加</button>

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
