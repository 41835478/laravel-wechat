<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 15/3/30
 * Time: 上午11:22
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
              <a class="btn btn-primary" href="{{ route('admin.public.create') }}">添加公众号</a>
          </div>
      </div>
  </div>
<!-- Removing search and results count filter -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">公众号列表</h3>

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
                             null,
                             null,
                             null,
                             null
                             ]
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
                    <th>ID</th>
                    <th>公众号</th>
                    <th>微信号</th>
                    <th>账号类型</th>
                    <th>Token</th>
                    <th>添加时间</th>
                    <th>操作</th>
                </tr>
            </thead>

            <tbody class="middle-align">
                @foreach($wechats as $wechat)
                <tr>
                    <td>
                        <input type="checkbox" class="cbr">
                    </td>
                    <td>{{ $wechat->id }}</td>
                    <td>{{ $wechat->public_name }}</td>
                    <td>{{ $wechat->wechat_account }}</td>
                    <td>@if($wechat->wechat_type=='subscribe') 订阅号 @elseif($wechat->wechat_type=='service') 服务号 @endif</td>
                    <td>{{ $wechat->wechat_token }}</td>
                    <td>{{ $wechat->created_at }}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-black dropdown-toggle" data-toggle="dropdown">
                                操作 <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-black" role="menu">
                                <li>
                                    <a href="{{route('admin.public.edit',$wechat->id)}}">编辑</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.public.destroy',$wechat->id)}}">删除</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">其他</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        {!!$wechats->render()!!}
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