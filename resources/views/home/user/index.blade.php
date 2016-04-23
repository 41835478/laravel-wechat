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
<title>个人中心</title>
    @include('home.user.common')
</head>

<body>

<div class="wrapper">
	<div class="g_header n_header">
        {!! Html::image('wechat/images/photo.png') !!}
    	<div class="n_name"></div>
    </div>
    <div class="n_top">
    	<div class="n_topleft">积分：<span>1000</span></div>
        <div class="n_topright"><a href="javascript:;"></a></div>
    </div>
    <ul class="n_list">
    	<li><div class="n_list01 n01"><a href="{{ url('user/carBind') }}"></a></div><div class="n_list02 n02"><a href="{{ url('user/userInfo') }}"></a></div></li>
        <li><div class="n_list01 n03"><a href="{{ url('user/queryViolation') }}"></a></div><div class="n_list02 n04"><a href="{{ url('user/userCollection') }}"></a></div></li>
        <li><div class="n_list01 n05"><a href="{{ url('user/queryScore') }}"></a></div><div class="n_list02 n06"><a href="{{ url('user/appointRecord') }}"></a></div></li>
        <li><div class="n_list01 n07"><a href="{{ url('user/oil') }}"></a></div><div class="n_list02 n08"><a href="{{ url('user/maintenance') }}"></a></div></li>
    </ul>
</div>

</body>
</html>
