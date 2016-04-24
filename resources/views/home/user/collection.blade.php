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
            @include('home.user.avatar',['path'=>$user->us_portrait])
        </div>
        <div class="c_header02">
        	<p>{{ $user->us_nick }}<span>积分：<i>{{ $user->us_integral }}</i></span></p>
            <div class="c_btn">
            	<a href="javascript:;" class="sign">签到</a> | <a href="{{ url('user/userCollection') }}" class="collect">收藏</a>
            </div>
        </div>
    </div>
    <div class="c_collectbox">
        @if(count($user->collects)>0)
    	<div class="c_collectyes">
        	<div id="wrapper3">
                <div id="scroller3">
                    <ul>
                        @foreach($user->collects as $collect)
                        <li><div><h2>{{ $collect->c_title }}</h2>{{ $collect->c_content }}</div>
                            {!! Html::image($collect->c_img) !!}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @else
        <div class="c_collectno">
            {!! Html::image('wechat/images/nocollect.png') !!}
        </div>
        @endif
    </div>
    <div class="c_tip">
    	<p>请关注我们推出的微信活动，例如动画展示、小游戏等形式，如发现页面上有“我要收藏”按钮便可收藏到这里来，并会有积分增加哦！</p>
    </div>
    @include('home.user.back')
    
</div>
</body>
</html>
