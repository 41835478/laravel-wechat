<html lang="en"><head>
    <meta charset="UTF-8">
    <title>车型列表</title>
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
                document.write('<meta name="viewport" content="width=device-width, minimum-scale = ' + phoneScale + ', maximum-scale = ' + phoneScale + ', target-densitydpi=device-dpi">');
            } else {
                document.write('<meta name="viewport" content="width=device-width,user-scalable =0, target-densitydpi=device-dpi">');
            }
        } else {
            document.write('<meta name="viewport" content="width=device-width, user-scalable=no, target-densitydpi=device-dpi">');
        }
        //微信去掉下方刷新栏
        if (navigator.userAgent.indexOf('MicroMessenger') >= 0) {
            document.addEventListener('WeixinJSBridgeReady', function () {
                WeixinJSBridge.call('hideToolbar');
            });
        }
    </script><meta name="viewport" content="width=device-width, minimum-scale = 0.5625, maximum-scale = 0.5625, target-densitydpi=device-dpi">
    <!--[END 浏览器兼容设置]-->
</head>
<body>

<link href="/css/base.css" rel="stylesheet">
<style>
    html, body {
        background: #f3f3f3;
        font-family: 'Microsoft YaHei';
    }

    .clear {
        clear: both;
    }

    #carlist {
        position: absolute;
        left: 0;
        top: 0;
        width: 640px;
        height: 100%;
    }

    #carlist .slider {
        width: 640px;
        overflow: hidden;
        position: relative;
        top: 0;
        left: 0;
    }

    #carlist .slider img {
        width: 640px;
    }

    #carlist .list {
        width: 640px;
    }

    #carlist .list .item {
        width: 600px;
        border-bottom: solid 1px #acacac;
        margin: 0 auto;
        margin-top: 10px;
        padding: 10px 0;
    }

    #carlist .list .left {
        float: left;
        width: 180px;
        margin-left: 50px;
        color: #494949;
    }

    #carlist .list .right {
        float: right;
        width: 300px;
        background: url(/images/sanjiao.png) no-repeat 265px 45px;
    }

    #carlist .list .right img {
        width: 260px;
        height: 150px;
        margin-right: 50px;
    }

    #carlist .list .left .t1 {
        font-size: 35px;
        font-weight: 800;
        border-bottom: solid 1px #acacac;
        height: 50px;
    }

    #carlist .list .left .t2 {
        margin-top: 10px;
        height: 25px;
        line-height: 25px;
        font-size: 20px;
    }

    #carlist .list .left .t3 {
        border-bottom: solid 1px #acacac;
        height: 40px;
        line-height: 40px;
        font-size: 26px;
        font-weight: 700;
    }

    #carlist .slider {
        overflow: hidden;
        height: 283px;
    }

    #carlist .slider .imgs ul {
        transition: all 1s linear;
    }

    #carlist .slider .imgs li {
        float: left;
        width: 640px;
    }

    #carlist .slider .controls {
        position: absolute;
        bottom: 10px;
        right: 10px;
    }

    #carlist .slider .controls a {
        background: #fff;
        display: inline-block;
        width: 30px;
        height: 30px;
        margin: 0 5px;
        border-radius: 15px;
        border: solid 1px #cfcece;
    }

    #carlist .slider .controls a.active {
    }

    #carlist .slider .controls a.active span {
        display: block;
        background: #555;
        width: 20px;
        height: 20px;
        margin: 5px;
        border-radius: 10px;
    }
</style>

<section id="carlist">
    <div class="top">
        <img src="/images/top.png">
    </div>
    <div class="slider">
        <div class="imgs">
            <ul style="width: 3200px;">
                @foreach($loopimgs as $img)
                <li><img src="{{ url($img->l_img) }}" style=" height:280px;"></li>
                @endforeach
                <div class="clear"></div>
            </ul>
        </div>

        <div class="controls">

        </div>
    </div>
    <div class="list">
        @foreach($series as $item)
        <a href="{{ url('user/series/'.$item->s_id) }}">
            <div class="item">
                <div class="left">
                    <div class="t1">{{ $item->s_name }}</div>
                    <div class="t2">官方指导价</div>
                    <div class="t3">
                        @foreach($item->carmodel as $k=>$car)
                            @if($k==0)
                            {{ $car->price }}
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="right">
                        @foreach($item->carmodel as $k=>$car)
                            @if($k==0)
                                <img src="{{ $car->images }}">
                            @endif
                        @endforeach
                </div>
                <div class="clear"></div>
            </div>
        </a>
        @endforeach

    </div>
</section>

{!! Html::script('javascripts/zepto.min.js') !!}
{!! Html::script('javascripts/touch.js') !!}
<script type="text/javascript">
    $(function () {
        //禁用不需要的浏览器默认行为
        //(function () {
        //    $win = $(window);
        //    //禁止ios的浏览器容器弹性
        //    $win.on('touchmove.elasticity', function (e) {
        //        e.preventDefault();
        //    });
        //})();
        var list = $(".slider");
        var len = list.find("li").length;
        var now = 0;
        var mn = false;
        $(".imgs ul", list).width(len * 640 + "px");
        for (var i = 0; i < len; i++) {
            if (i == 0) {
                $(".controls").append("<a class=\"active\"><span></span></a>");
            } else {
                $(".controls").append("<a><span></span></a>");
            }
        }
        function moveto(index) {
            if (mn) return;
            mn = true;
            setTimeout(function () {
                mn = false;
            }, 700);
            now += index;
            if (now < 0) now = len - 1;
            if (now > len - 1) now = 0;
            list.find(".controls a").removeClass("active").eq(now).addClass("active");
            list.find(".imgs ul").css({
                "transform": "translateX(" + (-now * 640) + "px)",
                "-webkit-transform": "translateX(" + (-now * 640) + "px)"
            });
        }

        list.swipeRight(function () {
            moveto(-1);
        });
        list.swipeLeft(function () {
            moveto(1);
        });
        var temp = { x: 0, y: 0 };
        var count = parseInt($("#carlist .list").height());
        $(window).on("touchstart", function (e) {
            temp.x = e.changedTouches[0].screenX;
            temp.y = e.changedTouches[0].screenY;
        }).on("touchmove", function (e) {
            var y = e.changedTouches[0].screenY-temp.y;
            var a = parseInt($("#carlist").css("margin-top"));
            console.log(y + a);
            if (y + a < 0&&y+a>-(count-$(window).height()+374)) {
                $("#carlist").css("margin-top", y + a + "px");
                temp.y = e.changedTouches[0].screenY;
            }
        });

    });
</script>

</body>
<iframe id="__WeixinJSBridgeIframe_SetResult" style="display: none;" src="weixin://private/setresult/SCENE_HANDLEMSGFROMWX&amp;eyJfX2Vycl9jb2RlIjoiY2I0MDQifQ=="></iframe>
<iframe id="__WeixinJSBridgeIframe" style="display: none;" src="weixin://dispatch_message/"></iframe>
</html>