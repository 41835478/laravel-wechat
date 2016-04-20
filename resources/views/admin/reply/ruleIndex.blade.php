@extends('layouts.admin.admin')
@section('content')

 @section('flash-message')
 @if (Session::has('flash_notification.message'))
     <div class="alert alert-{{ Session::get('flash_notification.level') }}">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

         {{ Session::get('flash_notification.message') }}
     </div>
 @endif
 @stop
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <a class="btn btn-primary" href="{{ route('admin.wechat-reply.subscribeCreate') }}">被添加自动回复</a>
            <a class="btn btn-primary" href="javascript:;">消息自动回复</a>
            <a class="btn btn-primary" href="{{ route('admin.wechat-reply.rule') }}">关键词自动回复</a>
        </div>
    </div>
</div>
<!-- Removing search and results count filter -->
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">规则列表</h3>
    <div class="panel-options">
      <button class="btn btn-secondary" data-toggle="modal" data-target="#ruleModal">添加规则</button>
    </div>
  </div>
  <div class="panel-body">
    <table class="table table-bordered table-striped" id="example-2">
        <thead>
          <tr>
            <th>规则名称</th>
            <th>操作</th>
          </tr>
        </thead>
        
        <tbody class="middle-align">
            @foreach($rules as $item)
            <tr>
                <td>{{ $item->rule_name }}</td>
                <td>
                    <button 
                      data-ruleid="{{ $item->id }}" 
                      class="btn btn-secondary btn-sm btn-icon icon-left">
                      修改
                    </button>
                    <button class="btn btn-danger btn-sm btn-icon icon-left">
                      删除
                    </button>
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
    {!!$rules->render()!!}
  </div>
</div>
@section('other')
@stop


@stop
@section('style')
    {!! Html::style('style/assets/js/datatables/dataTables.bootstrap.css') !!}
@stop
@section('script')
    {!! Html::script('style/assets/js/datatables/js/jquery.dataTables.min.js') !!}
    {!! Html::script('style/assets/js/datatables/dataTables.bootstrap.js') !!}
    {!! Html::script('style/assets/js/datatables/yadcf/jquery.dataTables.yadcf.js') !!}
    {!! Html::script('style/assets/js/datatables/tabletools/dataTables.tableTools.min.js') !!}
    {!! Html::script('style/assets/js/wechat-rule.js') !!}
@stop