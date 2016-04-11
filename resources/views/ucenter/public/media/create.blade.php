<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 7/27/15
 * Time: 11:24 AM
 */
 ?>
@section('flash-message')
@if (Session::has('flash_notification.message'))
   <div class="alert alert-{{ Session::get('flash_notification.level') }}">
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

       {{ Session::get('flash_notification.message') }}
   </div>
@endif
@stop
<div class="panel panel-default">

    <div class="panel-heading">
        <div class="panel-title">
            添加图文
        </div>

    </div>

    <div class="panel-body">


        {!! Form::open(['route'=>['ucenter.wechat.news.store',$wechatId],'role'=>'form','class'=>'validate','id'=>'save_news']) !!}

            <div class="form-group">
                <label class="control-label">标题</label>

                <input type="text" class="form-control" name="title" data-validate="required" data-message-required="This is custom message for required field." placeholder="标题" />
            </div>

            <div class="form-group">
                <label class="control-label">作者</label>

                <input type="text" class="form-control" name="author" data-validate="required" placeholder="作者" />
            </div>

            <div class="form-group">
                <label class="control-label">封面</label>

                <input type="text" class="form-control" name="pic_url" data-validate="required,url" placeholder="封面地址" />
            </div>

            <div class="form-group">
                <label class="control-label">描述</label>

                <input type="text" class="form-control" name="description" data-validate="required" placeholder="描述" />
            </div>

            <div class="form-group">
                <label class="control-label">内容</label>

                <textarea type="text" class="form-control" name="body" placeholder="内容" ></textarea>
            </div>

            <div class="form-group">
                <label class="control-label">原文地址</label>

                <input type="text" class="form-control" name="news_url" data-validate="url" placeholder="原文地址" />
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">保存</button>
                <button type="reset" class="btn btn-white">重置</button>
            </div>

        {!! Form::close() !!}

    </div>

</div>