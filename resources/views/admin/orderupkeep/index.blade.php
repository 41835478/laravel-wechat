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
<!-- Removing search and results count filter -->
<div class="panel panel-default">
				<div class="panel-heading">
                    <h3 class="panel-title">预约列表</h3>
                    
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
                                <th>客户姓名</th>
                                <th>客户性别</th>
                                <th>客户年龄</th>
                                <th>客户电话</th>
                                <th>客户积分</th>
                                <th>车系名</th>
                                <th>车型名</th>
                                <th>专营店名</th>
                                <th>预约状态</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        
                        <tbody class="middle-align">
                            @foreach($orders as $item)
                            <tr>
                                <td>
                                    <input type="checkbox" class="cbr">
                                </td>
                                <td>{{ $item->user->us_nick }}</td>
                                <td>{{ $item->user->gender }}</td>
                                <td>{{ $item->user->us_age }}</td>
                                <td>{{ $item->ou_tel }}</td>
                                <td>{{ $item->user->us_integral }}</td>
                                <td>{{ $item->st_tel }}</td>
                                <td>{{ $item->st_hottel }}</td>
                                <td>{{ $item->st_name }}</td>
                                <td>{{ $item->ou_state?'归档':'预约中' }}</td>
                                <td>
                                    <a href="{{route('admin.shop.edit',$item->st_id)}}" class="btn btn-secondary btn-sm btn-icon icon-left">
                                        编辑
                                    </a>

                                    {!! Form::open(['route'=>['admin.shop.destroy',$item->st_id],'role'=>'form','class'=>'form-horizontal','method'=>'delete','style'=>'display:inline']) !!}
                                    <button class="btn btn-danger btn-sm btn-icon icon-left">删除</button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    {!!$orders->render()!!}
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