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
<title>个人信息</title>
    @include('home.user.common')
</head>

<body>

<div class="wrapper">
	<div class="g_header">
        {!! Html::image('wechat/images/photo.png') !!}
    </div>
    <form method="get">
    	<div class="g_form">
        	<input class="txt01" type="text" name="" placeholder="请填写您的姓名"/>
            <select class="txt02"><option>男</option><option>女</option></select>
            <input class="txt03" type="text" name="" placeholder="请填写您的电话"/>
            <input class="txt04" type="text" name="" placeholder="请填写您的地址"/>
    	</div>
        <input class="txt05" name="" type="button" value="保存信息"/>
    </form>
    @include('home.user.back')
</div>

</body>
</html>
