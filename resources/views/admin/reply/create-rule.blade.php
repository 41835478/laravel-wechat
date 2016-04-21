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
  .media {
      margin-top: 15px
  }
  .media:first-child {
      margin-top: 0
  }
  .media,.media-body {
      overflow: hidden;
      zoom:1}
  .media-body {
      width: 10000px
  }
  .media-object {
    display: block;
    max-width: 100px;
    height: auto;
  }
  .media-object.img-thumbnail {
      max-width: none
  }
  .media-right,.media>.pull-right {
      padding-left: 10px
  }
  .media-left,.media>.pull-left {
      padding-right: 10px
  }
  .media-body,.media-left,.media-right {
      display: table-cell;
      vertical-align: top
  }
  .media-middle {
      vertical-align: middle
  }
  .media-bottom {
      vertical-align: bottom
  }
  .media-heading {
      margin-top: 0;
      margin-bottom: 5px
  }
  .media-list {
      padding-left: 0;
      list-style: none
  }
</style>
<div id="app" class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">添加规则</h3>
  </div>
  <div class="panel-body">
    <div class="form-group">
      <label class=" control-label" for="name">规则名称:</label>
      <div class="">
          <input type="text" class="form-control" name="name" id="name" v-model="rule_name">
      </div>
    </div>
    <div class="form-group-separator"></div>
    <div class="form-group">
      <label class=" control-label" for="name">关键字：</label>
      <div class="media" v-for="key in keywords">
        <div class="media-body">
          <input class="form-control" type="text" v-model="key.keyword">            
        </div>
        <div class="media-right">
          <label style="width: 70px;line-height: 32px;">
            <input 
              type="checkbox" 
              v-model="key.match_type"
              v-bind:true-value="1"
              v-bind:false-value="2">
            全匹配
          </label>            
        </div>
        <div class="media-right">
          <button class="btn btn-white btn-xs" @click="delKeyword($index)"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>          
      </div>
      <div class="media">
        <div class="media-body">
          <button class="btn btn-white btn-xs" @click="addKeyword">
            <i class="fa fa-plus"></i> 添加关键字
          </button>
        </div>
      </div>
    </div>
    <div class="form-group-separator"></div>
    <div class="form-group">
      <label class="control-label" for="name">回复信息:</label>
      <div>
        <button class="btn btn-white btn-xs" @click="showAddTextDialog"> 
          <i class="fa fa-file-text-o"></i> 添加文字消息
        </button>
        <button class="btn btn-white btn-xs" @click="showaddNewsDialog">
          <i class="fa fa-photo"></i> 添加图文消息
        </button>
      </div>
      <template v-for="reply in replies">
        <div v-if="reply.message_type == 'text'" class="media">
          <div class="media-body">
            <input class="form-control" type="text" v-model="reply.content">
          </div>
          <div class="media-right">
            <button class="btn btn-white btn-xs" @click="delReply($index)"><i class="fa fa-times" aria-hidden="true"></i></button>
          </div>
        </div>
        <div v-if="reply.message_type == 'news'" class="media">
          <div class="media-left">
            <a href="#">
              <img class="media-object" :src="'/' + reply.pic_url">
            </a>
          </div>
          <div class="media-body">
            <h4 class="media-heading">@{{reply.title}}</h4>
          </div>
          <div class="media-right">
            <button class="btn btn-white btn-xs" @click="delReply($index)"><i class="fa fa-times" aria-hidden="true"></i></button>
          </div>
        </div>       
      </template>
    </div>
    <div class="form-group-separator"></div> 
    <button class="btn btn-primary" @click="submitData">提交</button>           
  </div>
</div>
@section('other')
<!-- 添加回复文字 -->
<div id="dialogText" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">添加回复文字</h4>
      </div>
      <div class="modal-body">
        <textarea class="form-control"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" @click="addText">保存</button>
      </div>
    </div>
  </div>
</div>
<!-- 选择素材 -->
<div id="dialogNews" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">选择素材</h4>
      </div>
      <div class="modal-body">
        <div class="media" v-for="item in news">
          <div class="media-left">
            <input type="checkbox" v-model="item.checked">
          </div>          
          <div class="media-left">
            <a href="#">
              <img class="media-object" :src="'/' + item.pic_url">
            </a>
          </div>
          <div class="media-body">
            <h4 class="media-heading">@{{item.title}}</h4>
          </div>                             
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" @click="addNews">保存</button>
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
    {!! Html::script('style/assets/js/vue.js') !!}
    {!! Html::script('style/assets/js/wechat-rule-create.js') !!}
@stop