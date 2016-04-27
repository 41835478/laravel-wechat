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
                    <h3 class="panel-title">修改域名信息</h3>
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

                    {!! Form::open(['route'=>['admin.wechat-domain.update',$domain->id],'role'=>'form','class'=>'form-horizontal','method'=>'patch']) !!}

                    <div class="form-group @if($errors->first('domain')) has-error @endif">
                        <label class="col-sm-2 control-label" for="domain">域名</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $domain->domain }}" name="domain" id="domain" placeholder="@if($errors->first('domain')) {{$errors->first('domain')}} @else 域名 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('token')) has-error @endif">
                        <label class="col-sm-2 control-label" for="token" >密钥</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $domain->token }}" name="token" id="token" placeholder="@if($errors->first('token')) {{$errors->first('token')}} @else 密钥 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="remark">备注</label>

                        <div class="col-sm-10">
                            <textarea class="form-control" cols="5" name="remark" id="remark" placeholder="备注">{{ $domain->remark }}</textarea>
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('status')) has-error @endif">
                        <label class="col-sm-2 control-label">状态</label>

                        <div class="col-sm-10">

                            <p>
                                <label class="radio-inline">
                                    <input type="radio" name="status" @if($domain->status==0) checked @endif value="0">
                                    不可用
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" @if($domain->status==1) checked @endif value="1">
                                    可用
                                </label>
                                @if($errors->first('status')) {{$errors->first('status')}} @endif
                            </p>

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