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
<title>预约记录</title>
    @include('home.user.common')
    {!! Html::script('wechat/js/index.js') !!}
</head>

<body>

<div class="wrapper">
	<div class="c_header">
    	<div class="c_header01">
            @include('home.user.avatar',['path'=>$user->us_portrait])
        </div>
        <div class="c_header02">
        	<p>{{ $user->us_nick }}<span>积分：<i>{{ $user->us_integral }}</i></span></p>
            <div class="c_btn">
            	<a href="javascript:;" class="sign">签到</a> | <a href="javascript:;" class="collect">收藏</a>
            </div>
        </div>
    </div>
    
    <div class="h_result r_result">
    	<ul>
            @foreach($user->appoints as $appoint)
        	<li>
                <h2><span><i></i> {{ date('H:i',strtotime($appoint->od_date)) }}</span><i></i> {{ date('Y-m-d',strtotime($appoint->od_date)) }}</h2>
                <p>类型：试驾</p>
				<p>4s店：@if($appoint->shop){{ $appoint->shop->shopname }} @endif</p>
				<p>姓名：{{ $appoint->od_name }}</p>
				<p>电话：{{ $appoint->od_tel }}</p>
            </li>
            @endforeach

        </ul>
    </div>
    @include('home.user.back')
    
</div>

</body>
</html>
