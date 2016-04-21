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
            {{--<a class="btn btn-primary" href="javascript:;">消息自动回复</a>--}}
            <a class="btn btn-primary" href="{{ route('admin.wechat-reply.rule') }}">关键词自动回复</a>
        </div>
    </div>
</div>
<!-- Removing search and results count filter -->
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">规则列表</h3>
    <div class="panel-options">
      <button class="btn btn-secondary rule-create" data-go="{{ route('admin.wechat-reply.rule-create') }}" data-toggle="modal" data-target="#ruleModal">添加规则</button>
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
                      data-go = "{{ route('admin.wechat-reply.rule-edit',$item->id) }}"
                      class="btn btn-secondary btn-sm btn-icon icon-left rule-edit">
                      修改
                    </button>
                    <button 
                      data-ruleid="{{ $item->id }}"
                      class="rule-del btn btn-danger btn-sm btn-icon icon-left">
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
<div class="modal fade in" id="modalDel" data-backdrop="static" aria-hidden="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">删除确认</h4>
        </div>
        <div class="modal-body">
         你确定要删除这条规则吗？
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-del-rule btn btn-danger" data-dismiss="modal">确定</button>
        </div>
      </div>
    </div>
</div>
    <script>
        $('.rule-create').click(function(){
            var url = $(this).data('go');
            location.href = url;
        });
        //
        $('.rule-edit').click(function(){
            var url = $(this).data('go');
            location.href = url;
        });
        // 删除规则
        var toDelRuleId = null;
        var toDelEle = null;
        $('.rule-del').on('click', function(){
          var self = this;
          toDelRuleId = $(this).data('ruleid');
          toDelEle = $(self).closest('tr'); 
          $('#modalDel').modal('show', {backdrop: 'static'});
        });
        $('.btn-del-rule').on('click', function(){
          $.post('/api/delete-rule', { rule_id: toDelRuleId}, function(data){
            if(data.status == 200){
              toDelEle.remove();
              alert(data.msg);
            }
            else {
              alert(data.msg || '删除失败！');
            }
          });          
        });
    </script>
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
@stop