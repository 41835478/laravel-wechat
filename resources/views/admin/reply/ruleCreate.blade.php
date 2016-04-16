<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 16/4/13
 * Time: 下午2:44
 */
?>
<form role="form" class="form-horizontal">

    <div class="form-group has-error">
        <label class="col-sm-2 control-label" for="field-6">规则名</label>

        <div class="col-sm-10">
            <input type="text" name="rule_name" value="@if ($rule) {{ $rule->rule_name }} @endif" class="form-control" id="field-6" placeholder="规则名">
        </div>
        @if ($rule)
            {!! Form::hidden('id',$rule->id) !!}
        @endif
    </div>

</form>
