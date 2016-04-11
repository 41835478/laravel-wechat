<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 7/17/15
 * Time: 5:24 PM
 */
 ?>

<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 15/3/30
 * Time: 上午10:24
 */
 ?>
 @extends('layouts.ucenter.ucenter')

 @section('page-title')
    <div class="page-title">

        <div class="title-env">
            <h1 class="title">微信功能</h1>
            <p class="description">微信基本功能</p>
        </div>

        <div class="breadcrumb-env">

            <ol class="breadcrumb bc-1">
                <li>
                    <a href="#"><i class="fa-home"></i>个人中心</a>
                </li>
                <li>
                    <a href="#">微信功能</a>
                </li>
                <li class="active">
                    <strong>自动回复</strong>
                </li>
            </ol>

        </div>

    </div>
 @stop

 @section('right')

    <div class="col-md-9 mailbox-right">
        @include('ucenter.public.reply.nav')

        @if(Request::route('type')=='keywords')
            <button class="btn btn-secondary" id="mypopover" data-toggle="popover" data-trigger="click" data-placement="bottom">添加规则</button>
            <div class="row" id="keyword_item">
                @foreach($keyword_rules as $rule)
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{$rule->id}} ) {{$rule->rule_name}}</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                <h6>关键词</h6>
                                <blockquote style="font-size: 12px" id="kw_item_{{$rule->id}}">
                                    <table class="table table-condensed">
                                        <tbody>
                                        @foreach($rule->keywords as $kw)
                                            <tr>
                                                <td>{{$kw->keyword}}</td>
                                                <td>@if($kw->match_type==1) 模糊匹配 @elseif($kw->match_type==2) 全匹配 @endif</td>
                                                <td id="keyword_id_{{$kw->id}}" data-keyword_id="{{$kw->id}}" data-match_type="{{$kw->match_type}}" data-keyword="{{$kw->keyword}}">
                                                    <a href="javascript:;" id="edit_keyword" onclick="editKeyword($(this))" class="fa fa-edit"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a href="#" class="fa fa-trash"></a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </blockquote>
                                <a href="javascript:;" id="add_keyword_{{$rule->id}}" data-ruleid="{{$rule->id}}" onclick="addKeyword($(this))" class="btn btn-primary btn-single btn-xs">添加关键字</a>
                                </div>
                                <div class="col-sm-6">
                                <h6>自动回复:随机发送</h6>
                                <blockquote style="font-size: 12px" id="reply_item_{{$rule->id}}">
                                    <table class="table table-condensed">
                                        <tbody>
                                        @foreach($rule->reply as $reply)
                                            <tr>
                                                <td>{{ $reply->{$reply->reply_type}['content'] }}</td>
                                                <td><a href="#" class="linecons-pencil"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="linecons-trash"></a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </blockquote>
                                <div class="vertical-top">

                                    <button class="btn btn-icon btn-blue btn-xs" data-ruleid="{{$rule->id}}" onclick="addText($(this))" data-toggle="tooltip" data-placement="top" title="文字">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </button>

                                    <button class="btn btn-icon btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="图片">
                                        <i class="glyphicon glyphicon-picture"></i>
                                    </button>

                                    <button class="btn btn-icon btn-red btn-xs" data-toggle="tooltip" data-placement="top" title="声音">
                                        <i class="glyphicon glyphicon-music"></i>
                                    </button>

                                    <button class="btn btn-icon btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="视频">
                                        <i class="glyphicon glyphicon-facetime-video"></i>
                                    </button>

                                    <button class="btn btn-icon btn-info btn-xs" data-ruleid="{{$rule->id}}" onclick="addNews($(this))" data-toggle="tooltip" data-placement="top" title="图文">
                                        <i class="glyphicon glyphicon-list"></i>
                                    </button>
                                </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <script>
            var html = '<form role="form" class="form-horizontal" id="add-rule" action="{{route('ucenter.wechat.rule-store',$wechatId)}}">'+
                            '<div class="input-group">'+
                                '<input type="text" name="rule_name" class="form-control text-center" id="rule_name" placeholder="未命名规则">'+
                            '</div>'+
                            '<hr>'+
                            '<div class="input-group">'+
                                '<a class="btn btn-secondary btn-single" onclick="addKeywordRule()" id="add-rule-keyword">添加</a>'+
                                '<a class="btn btn-warning btn-single" onclick="hiddenPopover()" id="cancel-rule">取消</a>'+
                            '</div>'+
                        '</form>';

            var keywordForm = '添加关键字';

            $(document).ready(function(){
                $('#mypopover')
                    .data('content',html)
                    .popover({
                        html:true
                    });
            });
            function hiddenPopover(){
                $('#mypopover').popover('hide');
            }

            function addKeywordRule(){
                $.ajax({
                    type:'POST',
                    url:$('#add-rule').attr('action'),
                    data:{
                        'rule_name':$('input[name=rule_name]').val(),
                        'wechat_id':"{{$wechatId}}",
                        'match_type':$('input[name=match_type]').val()
                    },
                    success:function(data){
                        if(data.status=='success'){
                            hiddenPopover();
                            //添加关键词item
                            var item = '<div class="col-sm-12" >'+
                                '<div class="panel panel-default">'+
                                    '<div class="panel-heading">'+ data.keyword_rule.id +')'+ data.keyword_rule.rule_name +'</div>'+
                                    '<div class="panel-body">'+
                                        '<div class="row">'+
                                            '<div class="col-sm-6">'+
                                                '<h6>关键词</h6>'+
                                                '<blockquote style="font-size: 12px" id="kw_item_{{$rule->id}}">'+
                                                    '<table class="table table-condensed">'+
                                                        '<tbody>'+
                                                        '</tbody>'+
                                                    '</table>'+
                                                '</blockquote>'+
                                            '</div>'+
                                            '<div class="col-sm-6">'+
                                                '<h6>自动回复:随机发送</h6>'+
                                                '<p class="text-muted">Way now instrument had eat diminution melancholy expression.</p>'+
                                                '<p class="text-primary">Way now instrument had eat diminution melancholy expression.</p>'+
                                                '<p class="text-success">Way now instrument had eat diminution melancholy expression.</p>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
                            $('#keyword_item').prepend(item);
                        }
                    },
                    dataType:'json'
                });
            }

            //添加关键字
            function addKeyword(obj){
               var id = obj.attr('id');
               var keyword_rule_id = obj.data('ruleid');
               var form_action = "{{route('ucenter.wechat.keywords-store',$wechatId)}}";
               //更新表单action
               $('#keyword_form').attr('action',form_action);  //action
               $('input[name=keyword]').val('');       //keywords
               $('input[name=keyword_id]').val('');
               $('input[name=form_type]').val('create');   //form_type
               $('input[name=keyword_rule_id]').val(keyword_rule_id);  //rule_id

               jQuery('#keyword_modal').modal('show', {backdrop: 'static'});

            }

            //编辑关键字
            function editKeyword(obj){
                var keyword_id = obj.parent().data('keyword_id');
                var keyword = obj.parent().data('keyword');
                var match_type = obj.parent().data('match_type');     //
                var form_action = "{{route('ucenter.wechat.keywords-update',$wechatId)}}";

                //更新表单action
                $('#keyword_form').attr('action',form_action);
                $('input[name=keyword_id]').val(keyword_id);
                $('input[name=keyword]').val(keyword);  //keyword
                $('input[name=form_type]').val('update');  //form_type
                $('input[name=match_type][value='+ match_type +']').attr('checked',true);  //match_type
                //弹窗
                jQuery('#keyword_modal').modal('show', {backdrop: 'static'});
            }

            //添加回复

            function addText(obj)
            {
                var keyword_rule_id = obj.data('ruleid');

                $('#text_form input[name=keyword_rule_id]').val(keyword_rule_id);  //rule_id

                jQuery('#modal-text').modal('show', {backdrop: 'static'});
            }

            function addNews(obj)
            {
                var keyword_rule_id = obj.data('ruleid');
                 $('#news_form input[name=keyword_rule_id]').val(keyword_rule_id);  //rule_id

                 jQuery('#modal-news').modal('show', {backdrop: 'static'});
            }

            </script>
        @endif

        @if(Request::route('type')=='subscribe')
        这是关注自动回复
        @endif

        @if(Request::route('type')=='subscribe')
        这是关注自动回复
        @endif
    </div>
 @stop

 @section('left')
    @include('ucenter.left')
 @stop
 @section('other')
    <!-- Modal keyword-->
    <div class="modal fade" id="keyword_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">添加关键字</h4>
                </div>
                <div class="panel-body">
                    {!! Form::open(['route'=>['ucenter.wechat.keywords-store',$wechatId],'role'=>'form','class'=>'form-horizontal','id'=>'keyword_form']) !!}
                    {!! Form::hidden('keyword_rule_id') !!}
                    {!! Form::hidden('keyword_id') !!}
                    {!! Form::hidden('form_type') !!}
                    <div class="form-group">
                        <div class="form-group @if($errors->first('name')) has-error @endif">
                            <label class="col-sm-2 control-label" for="keyword">关键词</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="keyword" name="keyword" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">匹配类型</label>

                            <div class="col-sm-10">
                                <label class="radio-inline">
                                    <input type="radio" name="match_type" value="1" checked>
                                        模糊匹配
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="match_type" value="2">
                                        全匹配
                                </label>

                            </div>
                        </div>
                    </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" id="keword_save">保存</button>
                    <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                </div>
            {!! Form::close() !!}

            <script>
                $('#keword_save').click(function(){
                    var keyword_rule_id = $('#keyword_form input[name=keyword_rule_id]').val();
                    var keyword = $('#keyword_form input[name=keyword]').val();
                    var keyword_id = $('#keyword_form input[name=keyword_id]').val();
                    var form_type = $('#keyword_form input[name=form_type]').val();
                    var match_type = $('#keyword_form input[name=match_type]:checked').val();

                    var kw_item = '<tr><td>关键字</td><td>匹配类型</td>'+
                                       '<td><a href="#" class="fa fa-edit"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="fa fa-trash"></a></td>'+
                                   '</tr>';
                    $.ajax({
                        type:'POST',
                        url:$('#keyword_form').attr('action'),
                        data:{
                            'keyword_rule_id':keyword_rule_id,
                            'keyword_id':keyword_id,
                            'keyword':keyword,
                            'match_type':match_type,
                            'form_type':form_type
                        },
                        success:function(data){
                            $('#keyword_modal').modal('hide');  //隐藏模态框
                            if(data.form_type=='create'){
                                //添加关键字到列表
                                $("#kw_item_" + keyword_rule_id).find('tbody').prepend(kw_item);
                                 //查找节点
                                $("#kw_item_" + data.keyword.keyword_rule_id).find('tr td').eq(0).text(data.keyword.keyword);
                                if(data.keyword.match_type==1){
                                    $("#kw_item_" + data.keyword.keyword_rule_id).find('tr td').eq(1).text('模糊匹配');
                                }else{
                                    $("#kw_item_" + data.keyword.keyword_rule_id).find('tr td').eq(1).text('全匹配');
                                }
                                //操作连接
                            }else if(data.form_type=='update'){
                                var keyword_id = $('#keyword_id_' + data.keyword.id);

                                keyword_id.data('match_type',data.keyword.match_type);
                                keyword_id.data('keyword',data.keyword.keyword);

                                keyword_id.siblings().eq(0).text(data.keyword.keyword);
                                if(data.keyword.match_type==1){
                                    keyword_id.siblings().eq(1).text('模糊匹配');
                                }else{
                                    keyword_id.siblings().eq(1).text('全匹配');
                                }
                            }
                        },
                        dataType:'json'
                    });
                });
            </script>
            </div>
        </div>
    </div>

    <!-- Modal text-->
    <div class="modal fade" id="modal-text">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">添加文本</h4>
                </div>

                <div class="modal-body">
                    {!! Form::open(['route'=>['ucenter.wechat.reply-text',$wechatId],'role'=>'form','class'=>'form-horizontal','id'=>'text_form']) !!}
                    {!! Form::hidden('keyword_rule_id') !!}
                    {!! Form::hidden('reply_type','text') !!}
                    {!! Form::hidden('form_type','create') !!}
                    <div class="form-group no-margin">
                        <textarea class="form-control autogrow" id="msg_content" name="msg_content" placeholder="消息回复内容"></textarea>
                    </div>
                    {!! Form::close() !!}
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal" >关闭</button>
                    <button type="button" class="btn btn-info" id="text_save">保存</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#text_save').click(function(){
            var keyword_rule_id = $('#text_form input[name=keyword_rule_id]').val(),
                reply_type = $('#text_form input[name=reply_type]').val(),
                msg_content = $('#text_form textarea[name=msg_content]').val(),
                form_type = $('#text_form input[name=form_type]').val();
            $.ajax({
                type:'POST',
                url:$('#text_form').attr('action'),
                data:{
                    'keyword_rule_id':keyword_rule_id,
                    'reply_type':reply_type,
                    'msg_content':msg_content,
                    'form_type':form_type
                },
                success:function(data){
                    console.log(data.msg_content);
                },
                dataType:'json'

            });
        });
    </script>
    <!-- Modal text-->
    <div class="modal fade" id="modal-news">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">添加图文</h4>
                </div>

                <div class="modal-body">
                    {!! Form::open(['route'=>['ucenter.wechat.reply-news',$wechatId],'role'=>'form','class'=>'form-horizontal','id'=>'news_form']) !!}
                    {!! Form::hidden('keyword_rule_id') !!}
                    {!! Form::hidden('reply_type','news') !!}
                    {!! Form::hidden('form_type','create') !!}
                    <div class="form-group no-margin">
                        <input type="text" class="form-control" id="msg_content" name="msg_content" placeholder="图文ID" />
                    </div>
                    {!! Form::close() !!}
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal" >关闭</button>
                    <button type="button" class="btn btn-info" id="news_save">保存</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#news_save').click(function(){
            var keyword_rule_id = $('#news_form input[name=keyword_rule_id]').val(),
                reply_type = $('#news_form input[name=reply_type]').val(),
                msg_content = $('#news_form input[name=msg_content]').val(),
                form_type = $('#news_form input[name=form_type]').val();
            $.ajax({
                type:'POST',
                url:$('#news_form').attr('action'),
                data:{
                    'keyword_rule_id':keyword_rule_id,
                    'reply_type':reply_type,
                    'msg_content':msg_content,
                    'form_type':form_type
                },
                success:function(data){
                    console.log(data.msg_content);
                },
                dataType:'json'

            });
        });
    </script>

 @stop

 @section('style')
     {!! Html::style('style/assets/js/datatables/dataTables.bootstrap.css') !!}
     {!! Html::style('style/assets/js/dropzone/css/dropzone.css') !!}
 @stop
 @section('script')
     {!! Html::script('style/assets/js/dropzone/dropzone.min.js') !!}
     {!! Html::script('style/assets/js/tagsinput/bootstrap-tagsinput.min.js') !!}
 @stop
