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
            <a class="btn btn-primary" href="{{ route('admin.wechat-reply.create') }}">消息自动回复</a>
            <a class="btn btn-primary" href="{{ route('admin.wechat-reply.create') }}">关键词自动回复</a>
        </div>
    </div>
</div>
<!-- Removing search and results count filter -->
<!--
<div class="panel panel-default">
				<div class="panel-heading">
                    <h3 class="panel-title">会员列表</h3>
                    
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
                    
                    <script type="text/javascript">
                        jQuery(document).ready(function($)
                           {
                           $("#example-2").dataTable({
                             dom: "t" + "<'row'<'col-xs-6'i><'col-xs-6'p>>",
                             aoColumns: [
                                         {bSortable: false},
                                         null,
                                         null,
                                         null,
                                         null
                                         ],
                             });
                           
                           // Replace checkboxes when they appear
                           var $state = $("#example-2 thead input[type='checkbox']");
                           
                           $("#example-2").on('draw.dt', function()
                                              {
                                              cbr_replace();
                                              
                                              $state.trigger('change');
                                              });
                           
                           // Script to select all checkboxes
                           $state.on('change', function(ev)
                                     {
                                     var $chcks = $("#example-2 tbody input[type='checkbox']");
                                     
                                     if($state.is(':checked'))
                                     {
                                     $chcks.prop('checked', true).trigger('change');
                                     }
                                     else
                                     {
                                     $chcks.prop('checked', false).trigger('change');
                                     }
                                     });
                           });
                        </script>
                    
                    <table class="table table-bordered table-striped" id="example-2">
                        <thead>
                            <tr>
                                <th class="no-sorting">
                                    <input type="checkbox" class="cbr">
                                </th>
                                <th>用户名</th>
                                <th>EMAIL</th>
                                <th>注册时间 / 最后登陆</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        
                        <tbody class="middle-align">
                            @foreach($replies as $user)
                            <tr>
                                <td>
                                    <input type="checkbox" class="cbr">
                                        </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}<br/>{{ $user->updated_at}}</td>
                                <td>
                                    <a href="{{route('admin.user.edit',$user->id)}}" class="btn btn-secondary btn-sm btn-icon icon-left">
                                        编辑
                                    </a>
                                    
                                    <a href="#" class="btn btn-danger btn-sm btn-icon icon-left">
                                        删除
                                    </a>
                                    
                                    <a href="{{route('admin.user.profile',$user->id)}}" class="btn btn-info btn-sm btn-icon icon-left">
                                        查看
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    {!!$replies->render()!!}
                </div>
</div>
-->
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