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

<section class="gallery-env">

    <div class="row">

        <!-- Gallery Album Optipns and Images -->
        <div class="col-sm-12 gallery-right">

            <!-- Album Header -->
            <div class="album-header">
                <h2>图文消息</h2>

                <ul class="album-options list-unstyled list-inline">
                    <li>
                        <input type="checkbox" class="cbr" id="select-all" />
                        <label for="select-all">全选</label>
                    </li>
                    <li>
                        <a href="{{route('ucenter.wechat.news.create',$wechatId)}}">
                            <i class="fa-upload"></i>
                            添加图文
                        </a>
                    </li>
                    <li>
                        <a href="#" data-action="edit">
                            <i class="fa-edit"></i>
                            编辑
                        </a>
                    </li>
                    <li>
                        <a href="#" data-action="trash">
                            <i class="fa-trash"></i>
                            删除
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Album Images -->
            <div class="album-images row">
            @foreach($media as $m)
                <div class="col-md-4 col-sm-3 col-xs-6">
                    <div class="album-image">
                        <a href="#" class="thumb" data-action="edit">
                        {!! Html::image($m->pic_url,null,['class'=>'img-responsive']) !!}
                        </a>

                        <a href="#" class="name">
                            <span>{{$m->id}}</span>
                            <span>{{$m->title}}</span>
                            <em>{{$m->created_at}}</em>
                        </a>

                        <div class="image-options">
                            <a href="{{route('ucenter.wechat.news.edit',[$wechatId,$m->id])}}"><i class="fa-pencil"></i></a>
                            <a href="#" data-action="trash"><i class="fa-trash"></i></a>
                        </div>

                        <div class="image-checkbox">
                            <input type="checkbox" class="cbr" />
                        </div>
                    </div>
                </div>
            @endforeach

            </div>

            <button class="btn btn-white btn-block">
                <i class="fa-bars"></i>
                加载更多...
            </button>

        </div>


    </div>

</section>

@section('other')
<!-- Gallery Delete Image (Confirm)-->
<div class="modal fade" id="gallery-image-delete-modal" data-backdrop="static">
 		<div class="modal-dialog">
 			<div class="modal-content">

 				<div class="modal-header">
 					<h4 class="modal-title">确认删除？</h4>
 				</div>

 				<div class="modal-body">

 					你真的要删除么？

 				</div>

 				<div class="modal-footer">
 					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
 					<button type="button" class="btn btn-danger">Delete</button>
 				</div>
 			</div>
 		</div>
 	</div>
 @stop