@extends('layouts.admin.admin')
 @section('flash-message')
 @if (Session::has('flash_notification.message'))
     <div class="alert alert-{{ Session::get('flash_notification.level') }}">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

         {{ Session::get('flash_notification.message') }}
     </div>
 @endif
 @stop
@section('other')
    @include('upload.single_file',['type'=>'pic_url'])
@stop
@section('content')

<div class="row">
    <div class="col-sm-12">
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">图文消息</h3>
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
                
                {!! Form::open(['route'=>'admin.wechat-news.store','role'=>'form','class'=>'form-horizontal',]) !!}
                    
                    <div class="form-group @if($errors->first('title')) has-error @endif">
                        <label class="col-sm-2 control-label" for="title" >标题</label>
                        
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" id="title" placeholder="@if($errors->first('title')) {{$errors->first('title')}} @else 标题 @endif">
                        </div>
                    </div>
                    
                    <div class="form-group-separator"></div>
                    
                    <div class="form-group @if($errors->first('author')) has-error @endif">
                        <label class="col-sm-2 control-label" for="author">作者</label>
                        
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="author" id="author" placeholder="@if($errors->first('author')) {{$errors->first('author')}} @else 作者 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('photo')) has-error @endif">
                        <label class="col-sm-2 control-label" for="pic_url">封面</label>

                        <div class="col-sm-8">
                            <input type="text" name="pic_url" class="form-control"  id="pic_url" placeholder="@if($errors->first('pic_url')) {{$errors->first('pic_url')}} @else 封面图片地址 @endif">
                        </div>
                        <div class="col-sm-1">
                            <a href="javascript:;" onclick="jQuery('#upload').modal('show');" class="btn btn-primary btn-single btn-sm">上传图片</a>
                        </div>

                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="photo">预览</label>

                        <div class="col-sm-10" id="preview_pic">
                            <img src="" width="100%"/>
                        </div>


                    </div>

                    <div class="form-group-separator"></div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="description">摘要</label>
                        
                        <div class="col-sm-10">
                            <textarea class="form-control" cols="5" name="description" id="description" placeholder="摘要"></textarea>
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('news_url')) has-error @endif">
                        <label class="col-sm-2 control-label" for="news_url">原文链接</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="news_url" id="news_url" placeholder="@if($errors->first('news_url')) {{$errors->first('news_url')}} @else 原文链接 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>
                    
                    <div class="form-group @if($errors->first('status')) has-error @endif">
                        <label class="col-sm-2 control-label">状态</label>
                        
                        <div class="col-sm-10">
                            
                            <p>
                            <label class="radio-inline">
                                <input type="radio" name="status" value="0">
                                    不可用
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="status" value="1">
                                    可用
                            </label>
                            @if($errors->first('status')) {{$errors->first('status')}} @endif
                            </p>
                            
                        </div>
                    </div>
                    
                    <div class="form-group-separator"></div>

                    <div class="form-group">
                        {!! Form::label('body', '正文',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::textarea('body',null,[
                                'class'=>'form-control',
                                'placeholder'=>'正文'
                            ]) !!}
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        
                        <div class="col-sm-10">
                            
                            <button class="btn btn-danger">创建</button>
                            
                        </div>
                    </div>
                    
                {!! Form::close()!!}
                
            </div>
        </div>
        
    </div>
</div>
@stop
@section('script')

    {!! Html::script('ckeditor/ckeditor.js') !!}
    {!! Html::script('ckfinder/ckfinder.js') !!}
    {!! Html::script('ckeditor/adapters/jquery.js') !!}

    {!! Html::script('style/assets/js/dropzone/dropzone.min.js') !!}
    <script>
        var editor = CKEDITOR.replace( 'body' );
        CKFinder.setupCKEditor( editor, '/ckfinder/' );
    </script>

@stop