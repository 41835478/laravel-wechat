<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 16/4/13
 * Time: 下午2:44
 */
?>
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
  <div class="checkbox">
      <label>
        <input type="checkbox" name="reply_all"> 回复全部
      </label>
  </div>          
  <div class="tab-wrap">

    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#replyText" aria-controls="replyText" role="tab" data-toggle="tab">文字</a></li>
      <li role="presentation"><a href="#richText" aria-controls="richText" role="tab" data-toggle="tab">图文消息</a></li>
    </ul>

    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="replyText">
        <div class="pane-inner">
          <div class="form-group">
            <textarea class="text form-control" placeholder="请输入需要回复的文字"></textarea>
          </div>                  
        </div>

      </div>
      <div role="tabpanel" class="tab-pane" id="richText">
        <div class="pane-inner">
          <script id="container" name="content" type="text/plain">这里写你的初始化内容
          </script>
        </div>
      </div>
    </div>

  </div>
</form>  
<!-- <form role="form" class="form-horizontal">

    <div class="form-group has-error">
        <label class="col-sm-2 control-label" for="field-6">规则名</label>

        <div class="col-sm-10">
            <input type="text" name="rule_name" value="@if ($rule) {{ $rule->rule_name }} @endif" class="form-control" id="field-6" placeholder="规则名">
        </div>
        @if ($rule)
            {!! Form::hidden('id',$rule->id) !!}
        @endif
    </div>

</form> -->
