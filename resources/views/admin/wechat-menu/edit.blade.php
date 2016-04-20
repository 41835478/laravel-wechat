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
                <h3 class="panel-title">编辑@if($wechat_menu->menu_id)子@endif菜单</h3>
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

                {!! Form::open(['route'=>['admin.wechat-menu.update',$wechat_menu->id],'role'=>'form','class'=>'form-horizontal','method'=>'patch']) !!}

                    @if(isset($wechat_menu->menu_id))
                        {!! Form::hidden('menu_id',$wechat_menu->menu_id) !!}
                        {!! Form::hidden('level',2) !!}
                    @else
                        {!! Form::hidden('level',1) !!}
                    @endif

                    <div class="form-group @if($errors->first('name')) has-error @endif">
                        <label class="col-sm-2 control-label" for="name">菜单名称</label>

                        <div class="col-sm-10">
                            <input type="text" name="name" value="{{ $wechat_menu->name }}" class="form-control" id="name" placeholder="@if($errors->first('name')) {{$errors->first('name')}} @else 菜单名称 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('sort')) has-error @endif">
                        <label class="col-sm-2 control-label" for="sort">排序</label>

                        <div class="col-sm-10">
                            <input type="number" name="sort" value="{{ $wechat_menu->sort }}" class="form-control" id="sort" placeholder="@if($errors->first('sort')) {{$errors->first('sort')}} @else 菜单序号 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group menu-content">
                        <label class="col-sm-2 control-label">菜单内容</label>

                        <div class="col-sm-3">
                            <div class="form-block">
                                <label>
                                    <input type="radio" name="type" value="click" @if($wechat_menu->type=='click') checked @endif class="cbr cbr-primary">
                                    发送消息
                                </label>
                            </div>

                        </div>

                        <div class="col-sm-3">

                            <div class="form-block">
                                <label>
                                    <input type="radio" name="type" value="view" @if($wechat_menu->type=='view') checked @endif class="cbr cbr-primary">
                                    跳转网页
                                </label>
                            </div>

                        </div>

                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group new-form">
                        @if($wechat_menu->type=='view')
                            <label class="col-sm-2 control-label" for="content">页面地址</label>

                            <div class="col-sm-10">
                                <input type="text" name="content" value="{{ $wechat_menu->content }}" class="form-control" id="content" placeholder="页面地址">
                            </div>
                        @elseif($wechat_menu->type=='click')
                            <label class="col-sm-2 control-label" for="content">KEY</label>

                            <div class="col-sm-10">
                                <input type="text" name="key" value="{{ $wechat_menu->key }}" class="form-control" id="key" placeholder="KEY">
                            </div>
                        @endif
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>

                        <div class="col-sm-10">

                            <button class="btn btn-danger">保存</button>

                        </div>
                    </div>

                {!! Form::close() !!}

            </div>
        </div>

    </div>
</div>

 @stop
 @section('other')
    <script>
        //alert($('input[type=radio][name=type]').val());
        $('input[type=radio][name=type]').change(function(){
            var new_form = $('.new-form');
            var content = '';
            if (this.value=='click'){

                content += '<label class="col-sm-2 control-label" for="key">KEY</label>';
                content += '<div class="col-sm-10">';
                content += '<input type="text" name="key" @if($wechat_menu->type=='click') value="{{ $wechat_menu->key }}" @endif class="form-control" id="key" placeholder="KEY">';
                content += '</div>';
                new_form.html(content);

            }else if(this.value=='view')
            {
                content += '<label class="col-sm-2 control-label" for="content">页面地址</label>';
                content += '<div class="col-sm-10">';
                content += '<input type="text" name="content" @if($wechat_menu->type=='view') value="{{ $wechat_menu->content }}" @endif class="form-control" id="content" placeholder="页面地址">';
                content += '</div>';

                new_form.html(content);
            }
        });
    </script>
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
