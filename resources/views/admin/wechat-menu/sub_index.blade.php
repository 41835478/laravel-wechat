@extends('layouts.admin.admin')
@section('page-title')
    <div class="page-title">
        <div class="title-env">
            <h1 class="title">用户管理</h1>
            <p class="description">Dynamic table variants with pagination and other controls</p>
        </div>

        <div class="breadcrumb-env">

            <ol class="breadcrumb bc-1">
                <li>
                    <a href="dashboard-1.html"><i class="fa-home"></i>Dashboard</a>
                </li>
                <li>

                    <a href="tables-basic.html">用户中心</a>
                </li>
                <li class="active">

                    <strong>用户管理</strong>
                </li>
            </ol>

        </div>
    </div>
@stop
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
            <a class="btn btn-primary" href="{{ route('admin.wechat-menu.sub-create',$menu_id) }}">新子菜单</a>
        </div>
    </div>
</div>
<!-- Removing search and results count filter -->
<div class="panel panel-default">

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
                <th>排序</th>
                <th>菜单名称</th>
                <th>类型</th>
                <th>key</th>
                <th>操作</th>
            </tr>
            </thead>

            <tbody class="middle-align">
            @foreach($menus as $menu)
                <tr>
                    <td>
                        <input type="checkbox" class="cbr">
                    </td>
                    <th>{{ $menu->sort }}</th>
                    <td>{{ $menu->name }}</td>
                    <td>{{ $menu->type }}</td>
                    <td>{{ $menu->key }}</td>
                    <td>
                        <a href="{{route('admin.wechat-menu.edit',$menu->id)}}" class="btn btn-secondary btn-sm btn-icon icon-left">
                            修改
                        </a>

                        {!! Form::open(['route'=>['admin.wechat-menu.destroy',$menu->id],'role'=>'form','class'=>'form-horizontal','method'=>'delete','style'=>'display:inline']) !!}
                        <button class="btn btn-danger btn-sm btn-icon icon-left">删除</button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
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