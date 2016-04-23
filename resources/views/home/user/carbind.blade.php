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
<title>车辆绑定</title>
@include('home.user.common')
</head>

<body>

<div class="wrapper">
	<div class="c_header">
    	<div class="c_header01">
            @include('home.user.avatar',['path'=>$user->us_portrait])
        </div>
        <div class="c_header02">
        	<p>adriana Lima<span>积分：<i>1000</i></span></p>
            <div class="c_btn">
            	<a href="javascript:;" class="sign">签到</a> | <a href="javascript:;" class="collect">收藏</a>
            </div>
        </div>
    </div>
    <form method="get">
    	<div class="c_form">
        	<input class="txt01" type="text" name="us_carno" value="{{ $user->us_carno }}" placeholder="请输入车架号后8位"/>
            <input class="txt02" type="text" name="us_tel" value="{{ $user->us_tel }}" placeholder="请输入手机号码"/>
            <input class="txt03" type="text" name="captcha" placeholder="请输入下方图片上的验证码"/>
    	</div>
        <div class="c_code">
        	<div class="c_code01">{!!  captcha_img() !!}</div>
            <input type="hidden" name="captcha" >
            <div class="c_code02">
            	<p>车辆绑定后违章查询</p>
                <p class="c_code02p">可&nbsp;·&nbsp;快&nbsp;·&nbsp;捷&nbsp;·&nbsp;查&nbsp;·&nbsp;询</p>
            </div>
        </div>
        <input class="txt05 c_carbind" type="button" name="" value="确认绑定"/>
    </form>
    @include('home.user.back')
    
</div>

</body>
</html>
