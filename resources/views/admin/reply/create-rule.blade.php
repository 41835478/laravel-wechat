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
<style>
  .pane-inner{
    margin-top:5px;
  }
  .tag-input {
    display: block;
    width: 100%;
    height: 48px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
  }
  .tag-input .keywords{
    font-style: normal;
  }
  .tag-input span{
    text-align: center;
    border-radius: 4px;
    color:#fff;
    background-color: #337ab7;
    padding: 5px 15px 5px 10px;
    margin-right:5px;
    cursor: pointer;
    position: relative;
  }
  .tag-input span:hover{
    color: #fff;
    background-color: #286090;
  }
  .tag-input span::after{
    content: '\00d7';
    position: absolute;
    top: 2px;
    right: 5px;
  }

  .tag-input input{
    border:none;
    height: 34px;
    padding: 2px 3px;
  }
  .tag-input input:hover,
  .tag-input input:active,
  .tag-input input:focus {
    border:none;
    height: 34px;
    padding: 2px 3px;
    outline: none;
  }  
</style>
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

            <tr>
                <td>默认规则名</td>
                <td>
                    <button 
                      data-ruleid="1"
                      data-toggle="modal" 
                      data-target="#ruleModal"
                      data-rule='{"name":"规则名称","keywords":["关键词列表","ab","cd"],"text":"文字信息", "reply_all":true, "richText": "<p><strong>图文消息</strong></p>"}'
                      class="btn btn-secondary btn-sm btn-icon icon-left">
                      修改
                    </button>
                    <button class="btn btn-danger btn-sm btn-icon icon-left">
                      删除
                    </button>
                </td>
            </tr>
            <tr>
                <td>默认规则名</td>
                <td>
                    <button
                            data-ruleid="1"
                            data-toggle="modal"
                            data-target="#ruleModal"
                            data-rule='{"name":"规则名称","keywords":["关键词列表","ab","cd"],"text":"文字信息", "reply_all":true, "richText": "<p><strong>图文消息</strong></p>"}'
                            class="btn btn-secondary btn-sm btn-icon icon-left">
                        修改
                    </button>
                    <button class="btn btn-danger btn-sm btn-icon icon-left">
                        删除
                    </button>
                </td>
            </tr>
            <tr>
                <td>默认规则名</td>
                <td>
                    <button
                            data-ruleid="1"
                            data-toggle="modal"
                            data-target="#ruleModal"
                            data-rule='{"name":"规则名称","keywords":["关键词列表","ab","cd"],"text":"文字信息", "reply_all":true, "richText": "<p><strong>图文消息</strong></p>"}'
                            class="btn btn-secondary btn-sm btn-icon icon-left">
                        修改
                    </button>
                    <button class="btn btn-danger btn-sm btn-icon icon-left">
                        删除
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

  </div>
</div>
@section('other')
  <!-- 添加规则模版 -->
  <div class="dialog-rule-edit modal fade" id="ruleModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">关键词规则</h4>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="exampleInputEmail1">规则名称：</label>
              <input type="text" class="form-control" name="ruleName">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">关键词列表：</label>
              <div class="tag-input form-control">
                <i class="keywords"></i>
                <input type="text">
              </div>
            </div> 
            <div class="form-group">
              <label>文字消息：</label>
              <textarea class="text form-control" placeholder="请输入需要回复的文字"></textarea>
            </div>
            <div class="form-group">
              <label>图文消息：</label>
              <script id="container" name="content" type="text/plain"></script>
            </div>
            <div class="checkbox">
                <label>
                  <input type="checkbox" name="reply_all"> 回复全部
                </label>
            </div>            
          </form>        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          <button id="ruleSave" type="button" class="btn btn-primary">保存</button>
        </div>
      </div>
    </div>
  </div>
@stop


@stop
@section('style')
    {!! Html::style('style/assets/js/datatables/dataTables.bootstrap.css') !!}
@stop
@section('script')
    {!! Html::script('style/assets/js/ueditor/ueditor.config.js') !!}
    {!! Html::script('style/assets/js/ueditor/ueditor.all.js') !!}
    {!! Html::script('style/assets/js/datatables/js/jquery.dataTables.min.js') !!}
    {!! Html::script('style/assets/js/datatables/dataTables.bootstrap.js') !!}
    {!! Html::script('style/assets/js/datatables/yadcf/jquery.dataTables.yadcf.js') !!}
    {!! Html::script('style/assets/js/datatables/tabletools/dataTables.tableTools.min.js') !!}
    {!! Html::script('style/assets/js/wechat-rule.js') !!}
@stop