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
<title>违章查询</title>
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
    	<div class="i_form">
        	<select class="txt01"><option>北京</option><option>上海</option></select>
            <select class="txt02"><option>东城区</option><option>西城区</option></select>
        	<select class="txt03"><option>京</option></select>
            <input class="txt04" name="" type="text" placeholder="请输入车牌号"/>
            <select class="txt07"><option>请选择车型</option></select>
            <input class="txt08" type="text" name="" placeholder="请输入所有发动机号"/>
    	</div>
        
        <input type="button" class="txt05 c_carbind" name="" value="违章查询"/>
    </form>
    @include('home.user.back')
    
</div>

</body>
</html>
