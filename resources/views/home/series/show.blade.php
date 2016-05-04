<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <title>车型展示</title>
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache,must-revalidate">
    <meta http-equiv="expires" content="0">
    <meta name="keywords" content="关键字">
    <meta name="description" content="内容">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="Expires" content="-1">

    <!--浏览器兼容设置-->
    <script type="text/javascript">
        //移动端兼容适配
        if (/Android\s(\d+\.\d+)/.test(navigator.userAgent)) {
            var version = parseFloat(RegExp.$1);
            if (version > 2.3) {
                var phoneScale = parseInt(window.screen.width) / 640;
                document.write('<meta name="viewport" content="width=640, minimum-scale = ' + phoneScale + ', maximum-scale = ' + phoneScale + ', target-densitydpi=device-dpi">');
            } else {
                document.write('<meta name="viewport" content="width=640,user-scalable =0, target-densitydpi=device-dpi">');
            }
        } else {
            document.write('<meta name="viewport" content="width=640, user-scalable=no, target-densitydpi=device-dpi">');
        }
        //微信去掉下方刷新栏
        if (navigator.userAgent.indexOf('MicroMessenger') >= 0) {
            document.addEventListener('WeixinJSBridgeReady', function () {
                WeixinJSBridge.call('hideToolbar');
            });
        }
    </script>
    <meta name="viewport" content="width=640,target-densitydpi=device-dpi,user-scalable=no">
    <!--[END 浏览器兼容设置]-->
</head>
<body>
{!! Html::style('css/base.css') !!}
<style>
    .top {
        height: 88px;
        background: url(/images/showtop.png) no-repeat;
    }

    .top .fl {
        display: block;
        width: 200px;
        height: 88px;
    }

    #detail {
        margin-bottom: 100px;
    }

    #detail img {
        width: 640px;
    }

    footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 640px;
        height: 100px;
        background: #edeeef;
        text-align:center;
    }

    footer a {
        display: inline-block;
        width: 32%;
        height: 100px;
        font-size: 28px;
        text-align: center;
        padding-top: 30px;
        background: linear-gradient(top,#fff,#e7e7e7);
        color: #555;
        font-weight: 700;
        text-decoration: none;

    }

    footer a i {
        display: inline-block;
        width: 30px;
        height: 30px;
        background: url(/images/icons.png) no-repeat;
        background: linear-gradient(top,#c5c5c5,#d2d2d2);
    }

    footer .info {
        border-left: solid 1px #afafb0;
        border-right: solid 1px #afafb0;
    }

    footer .tel i {
        background-position: 2px 4px;
    }

    footer .info i {
        background-position: -23px 5px;
    }

    footer .shijia i {
        background-position: -49px 6px;
    }
</style>
<div class="top">
    <a href="index" class="fl"></a>
</div>
<section id="detail">
    @foreach($series->carmodel as $item)
        @foreach($item->carImages as $img)
            <p><a><img src="{{ url($img->images) }}"></a></p>
        @endforeach
    @endforeach

</section>


<footer>
    <a class="tel" href="tel:4008833666"><i></i>电话咨询</a>
    <a class="info" href="@if($series->carmodel){{ url($series->carmodel[0]->path) }} @endif"><i></i>车型详情</a>

    <a class="shijia" href="{{ url('user/appointment') }}"><i></i>预约试驾</a>
</footer>



</body><iframe id="__WeixinJSBridgeIframe_SetResult" style="display: none;" src="weixin://private/setresult/SCENE_HANDLEMSGFROMWX&amp;eyJfX2Vycl9jb2RlIjoiY2I0MDQifQ=="></iframe><iframe id="__WeixinJSBridgeIframe" style="display: none;" src="weixin://dispatch_message/"></iframe></html>