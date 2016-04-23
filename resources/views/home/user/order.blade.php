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
            {!! Html::image('wechat/images/photo.png') !!}
        </div>
        <div class="c_header02">
        	<p>adriana Lima<span>积分：<i>1000</i></span></p>
            <div class="c_btn">
            	<a href="javascript:;" class="sign">签到</a> | <a href="javascript:;" class="collect">收藏</a>
            </div>
        </div>
    </div>
    
    <div class="h_result r_result">
    	<ul>
        	<li>
                <h2><span><i></i> 22:56</span><i></i> 2016-04-16</h2>
                <p>类型：保养</p>
				<p>4s店：北京达畅陆风汽车经销有限公司</p>
				<p>姓名：adriana Lima</p>
				<p>电话：13265656547</p>
            </li>
            <li>
                <h2><span><i></i> 22:56</span><i></i> 2016-04-16</h2>
                <p>类型：保养</p>
				<p>4s店：北京达畅陆风汽车经销有限公司</p>
				<p>姓名：adriana Lima</p>
				<p>电话：13265656547</p>
            </li>
            <li>
                <h2><span><i></i> 22:56</span><i></i> 2016-04-16</h2>
                <p>类型：保养</p>
				<p>4s店：北京达畅陆风汽车经销有限公司</p>
				<p>姓名：adriana Lima</p>
				<p>电话：13265656547</p>
            </li>
        </ul>
    </div>
    @include('home.user.back')
    
</div>

</body>
</html>
