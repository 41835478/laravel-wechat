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
                    <h3 class="panel-title">编辑车型</h3>
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

                    {!! Form::open(['route'=>['admin.carmodel.store'],'role'=>'form','class'=>'form-horizontal']) !!}

                    <div class="form-group @if($errors->first('s_id')) has-error @endif">
                        <label class="col-sm-2 control-label" for="s_id">车系名称</label>

                        <div class="col-sm-10">
                            <select class="form-control" name="s_id">
                                <option value="0">请选择</option>
                                @foreach($series as $sery)
                                    <option value="{{ $sery->s_id }}">{{ $sery->s_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('models')) has-error @endif">
                        <label class="col-sm-2 control-label" for="models" >车型名称</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="models" id="models" placeholder="@if($errors->first('models')) {{$errors->first('models')}} @else 车型名称 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('images')) has-error @endif">
                        <label class="col-sm-2 control-label" for="images">封面</label>

                        <div class="col-sm-8">
                            <input type="text" name="images" class="form-control"  id="pic_url" placeholder="@if($errors->first('images')) {{$errors->first('images')}} @else 图片地址 @endif">
                        </div>
                        <div class="col-sm-1">
                            <a href="javascript:;" onclick="jQuery('#upload').modal('show');" class="btn btn-primary btn-single btn-sm">上传图片</a>
                        </div>

                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="photo">预览</label>

                        <div class="col-sm-10" id="preview_pic">
                        </div>


                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('tel')) has-error @endif">
                        <label class="col-sm-2 control-label" for="tel" >联系热线</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="tel" id="tel" placeholder="@if($errors->first('tel')) {{$errors->first('tel')}} @else 联系热线 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group @if($errors->first('path')) has-error @endif">
                        <label class="col-sm-2 control-label" for="path" >车型详情地址链接</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="path" id="path" placeholder="@if($errors->first('path')) {{$errors->first('path')}} @else 车型详情地址链接 @endif">
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group">
                        {!! Form::label('body', '正文',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::textarea('txt',null,[
                                'class'=>'form-control',
                                'placeholder'=>'正文'
                            ]) !!}
                        </div>
                    </div>


                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>

                        <div class="col-sm-10">

                            <button class="btn btn-danger">更新</button>

                        </div>
                    </div>

                    {!! Form::close()!!}

                </div>
            </div>

        </div>
    </div>
@stop
@section('other')
    @include('upload.single_file',['type'=>'car_model'])
@stop
@section('script')

    {!! Html::script('ckeditor/ckeditor.js') !!}
    {!! Html::script('ckfinder/ckfinder.js') !!}
    {!! Html::script('ckeditor/adapters/jquery.js') !!}

    {!! Html::script('style/assets/js/dropzone/dropzone.min.js') !!}
    <script>
        var editor = CKEDITOR.replace( 'txt' );
        CKFinder.setupCKEditor( editor, '/ckfinder/' );
    </script>

@stop