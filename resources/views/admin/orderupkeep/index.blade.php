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
                                <th>专营店名</th>
                                <th>专营店地址</th>
                                <th>预约类型</th>
                                <th>客户所在地</th>
                                <th>积分</th>
                                <th>预约时间</th>
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
                                <td>{{ $item->ou_name }}</td>
                                <td>{{ $item->user->us_gender?'女':'男' }}</td>
                                <td>{{ $item->user->us_age }}</td>
                                <td>@if($item->station){{ $item->station->stationname }} @endif</td>
                                <td>@if($item->station) {{ $item->station->address }} @endif</td>
                                <td>{{ $item->ou_type }}</td>
                                <td>{{ $item->user->us_address }}</td>
                                <td>{{ $item->user->us_integral }}</td>
                                <td>{{ $item->ou_date }}</td>
                                <td>{{ $item->ou_state?'已归档':'预约中' }}</td>
                                <td>
                                    <a href="{{route('admin.orderupkeep.edit',$item->ou_id)}}" class="btn btn-secondary btn-sm btn-icon icon-left">
                                        修改
                                    </a>
                                    <a href="{{route('admin.orderupkeep.show',$item->ou_id)}}" class="btn btn-secondary btn-sm btn-icon icon-left">
                                        详细
                                    </a>
                                    <a href="{{route('admin.orderupkeep.archive',$item->ou_id)}}" class="btn btn-secondary btn-sm btn-icon icon-left">
                                        预约归档
                                    </a>
                                    {{--{!! Form::open(['route'=>['admin.shop.destroy',$item->ou_id],'role'=>'form','class'=>'form-horizontal','method'=>'delete','style'=>'display:inline']) !!}--}}
                                    {{--<button class="btn btn-danger btn-sm btn-icon icon-left">删除</button>--}}
                                    {{--{!! Form::close() !!}--}}
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