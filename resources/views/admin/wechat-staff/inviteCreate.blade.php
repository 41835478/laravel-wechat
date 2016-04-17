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
        <label class="col-sm-2 control-label" for="finvite_wx">微信号</label>

        <div class="col-sm-10">
            <input type="text" name="invite_wx" class="form-control" id="invite_wx" placeholder="微信号">
        </div>
        {!! Form::hidden('kf_account',$kf_account) !!}
    </div>

</form>
