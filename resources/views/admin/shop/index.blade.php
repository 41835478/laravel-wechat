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
            <a class="btn btn-primary" href="{{ route('admin.shop.create') }}">添加4S店</a>
        </div>
    </div>
</div>
<!-- Removing search and results count filter -->
<div class="panel panel-default">
				<div class="panel-heading">
                    <h3 class="panel-title">4S店列表</h3>
                    
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
                                <th>专营店名称</th>
                                <th>专营店地址</th>
                                <th>紧急救缓</th>
                                <th>销售热线</th>
                                <th>专营店状态</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        
                        <tbody class="middle-align">
                            @foreach($shops as $item)
                            <tr>
                                <td>
                                    <input type="checkbox" class="cbr">
                                </td>
                                <td>{{ $item->shopname }}</td>
                                <td>{{ $item->address }}</td>
                                <td>{{ $item->tel1 }}</td>
                                <td>{{ $item->tel2 }}</td>
                                <td>{{ $item->state?'归档':'正常' }}</td>
                                <td>
                                    <a href="{{route('admin.shop.edit',$item->id)}}" class="btn btn-secondary btn-sm btn-icon icon-left">
                                        编辑
                                    </a>

                                    {!! Form::open(['route'=>['admin.shop.destroy',$item->id],'role'=>'form','class'=>'form-horizontal','method'=>'delete','style'=>'display:inline']) !!}
                                    <button class="btn btn-danger btn-sm btn-icon icon-left">删除</button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    {!!$shops->render()!!}
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