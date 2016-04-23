<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=640,target-densitydpi=device-dpi,user-scalable=no">
<meta content="yes" name="apple-mobile-web-app-capable"/>
<meta name="format-detection" content="telephone=no" />
<meta content="black" name="apple-mobile-web-app-status-bar-style"/>
<meta name="Keywords" content="陆风" />
<meta name="description" content="陆风" />
<title>我的收藏</title>
@include('home.user.common')
{!! Html::script('wechat/js/iscroll.js') !!}
{!! Html::script('wechat/js/index.js') !!}
</head>

<body>

<div class="wrapper collection">
	<div class="c_header">
    	<div class="c_header01">
            {!! Html::image('wechat/images/photo.png') !!}
        </div>
        <div class="c_header02">
        	<p>adriana Lima<span>积分：<i>1000</i></span></p>
            <div class="c_btn">
            	<a href="javascript:;" class="sign">签到</a> | <a href="javascript:;" class="collect">收藏</a>
            </div>
        </div>
    </div>
    <div class="c_collectbox">
    	<div class="c_collectyes">
        	<div id="wrapper3">
                <div id="scroller3">
                    <ul>
                        <li><div>陆风x7惊艳亮相！快来体验全新梦想suv！</div>{!! Html::image('wechat/images/tp.jpg') !!}</li>
                        <li><div><h2>天上掉下个陆妹妹</h2>羊光明媚过大年</div>{!! Html::image('wechat/images/tp.jpg') !!}</li>
                        <li><div>陆风x7惊艳亮相！快来体验全新梦想suv！</div>{!! Html::image('wechat/images/tp.jpg') !!}</li>
                        <li><div><h2>天上掉下个陆妹妹</h2>羊光明媚过大年</div>{!! Html::image('wechat/images/tp.jpg') !!}</li>
                        <li><div>陆风x7惊艳亮相！快来体验全新梦想suv！</div>{!! Html::image('wechat/images/tp.jpg') !!}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="c_collectno" style="display: none;">
        	<img src="images/nocollect.png"/>
        </div>
    </div>
    <div class="c_tip">
    	<p>请关注我们推出的微信活动，例如动画展示、小游戏等形式，如发现页面上有“我要收藏”按钮便可收藏到这里来，并会有积分增加哦！</p>
    </div>
    @include('home.user.back')
    
</div>
</body>
</html>
