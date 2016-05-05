<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 16/4/23
 * Time: 上午11:28
 */
?>
{!! Html::style('wechat/css/style.css') !!}
{!! Html::script('wechat/js/jquery-2.1.0.min.js') !!}
<script>
    var user_id = "{{ $user->us_id }}";
    var host = "{{ url() }}";
</script>
{!! Html::script('wechat/js/api.js?v=1111') !!}
