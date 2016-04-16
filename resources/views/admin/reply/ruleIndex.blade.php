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
                    <a class="btn btn-secondary show-modal" href="javascript:;">添加规则</a>
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
                                <th>规则名称</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        
                        <tbody class="middle-align">
                            @foreach($rules as $item)
                            <tr>
                                <td>
                                    <input type="checkbox" class="cbr">
                                </td>
                                <td>{{ $item->rule_name }}</td>
                                <td>
                                    <a href="javascript:;" data-ruleid="{{ $item->id }}" class="btn btn-secondary btn-sm btn-icon icon-left show-modal">
                                        修改
                                    </a>
                                    <a href="javascript:;" class="btn btn-secondary btn-sm btn-icon icon-left show-keyword">
                                        关键字
                                    </a>
                                    
                                    <a href="#" class="btn btn-danger btn-sm btn-icon icon-left">
                                        回复
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    {!!$rules->render()!!}
                </div>
</div>


@stop
@section('other')
    <script type="text/javascript">
        $('.show-modal').click(function(){
            var obj = $(this);
            showAjaxModal(obj);
        });
        function showAjaxModal(obj)
        {
            jQuery('#modal-7').modal('show');
            rule_id = obj.data('ruleid') || '';

            var data = {rule_id:rule_id};
            jQuery.ajax({
                url: "{{route('admin.wechat-reply.rule-createOrEdit')}}",
                data:data,
                type:'post',
                success: function(response)
                {
                    jQuery('#modal-7 .modal-body').html(response);
                },
                async:false
            });
        }
        function showKeywordModal()
        {

        }
    </script>
    <!-- Modal 7 (Ajax Modal)-->
    <div class="modal fade" id="modal-7">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">关键词规则</h4>
                </div>

                <div class="modal-body">

                    Content is loading...

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-info save">保存</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.save').click(function(){
            //var rule = $('#modal-7 input[name=rule_name]').val();
            var data = $('#modal-7 form').serialize();
            $.ajax({
                url:"{{ route('admin.wechat-reply.rule-store') }}",
                type:'post',
                data:data,
                success: function(response)
                {
                    if (response.status==200){
                        console.log(response.mgs);
                        jQuery('#modal-7').modal('hide');
                    }
                },
                dataType:'json'
            });
        });
    </script>
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