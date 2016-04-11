@extends('layouts.ucenter.ucenter')
@section('flash-message')
 @if (Session::has('flash_notification.message'))
     <div class="alert alert-{{ Session::get('flash_notification.level') }}">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

         {{ Session::get('flash_notification.message') }}
     </div>
 @endif
 @stop
@section('main')
<div class="bs-example" data-example-id="thumbnails-with-custom-content">

<div class="panel panel-default">
    <div class="panel-heading">
        选择公众号
    </div>
    <div class="row">
    @foreach($wechats as $wechat)
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <div class="caption">
            <h3>{{$wechat->public_name}}</h3>
            <p>{{$wechat->public_name}}</p>
            <p>{{$wechat->wechat_token}}</p>
            <p>
                <a href="{{route('ucenter.wechat.manage',$wechat->id)}}" class="btn btn-primary" role="button">进入</a>
                <a href="{{route('ucenter.wechat.edit',$wechat->id)}}" class="btn btn-default" role="button">修改</a>
            </p>
          </div>
        </div>
      </div>
    @endforeach

    </div>
   </div>
  </div>

@stop

@section('style')
    {!! Html::style('style/assets/js/datatables/dataTables.bootstrap.css') !!}
@stop
@section('script')
    {!! Html::script('style/assets/js/datatables/js/jquery.dataTables.min.js') !!}
    {!! Html::script('style/assets/js/datatables/dataTables.bootstrap.js') !!}
    {!! Html::script('style/assets/js/datatables/yadcf/jquery.dataTables.yadcf.js') !!}
    {!! Html::script('style/assets/js/datatables/tabletools/dataTables.tableTools.min.js') !!}
@stop