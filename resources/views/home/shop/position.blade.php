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
<title>4s店查询</title>
    @include('home.user.common')
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        wx.config(<?php echo $js->config(array('getLocation', 'openLocation'), true) ?>);
        wx.ready(function () {
           //自动获取位置
            wx.getLocation({
                success: function (res) {
                    alert(JSON.stringify(res));
                },
                cancel: function (res) {
                    alert('用户拒绝授权获取地理位置');
                }
            });
           // 重新获取位置
            $('.s_btn').click(function(){
                wx.getLocation({
                    success: function (res) {
                        alert(JSON.stringify(res));
                    },
                    cancel: function (res) {
                        alert('用户拒绝授权获取地理位置');
                    }
                });
            });
        });
    </script>
</head>

<body>

<div class="wrapper">
	<div class="s_top">
        {!! Html::image('wechat/images/logo.png') !!}<p>4s店查询</p>
    </div>
    <div class="s_position">
    	<a class="s_btn">重新定位</a>
    	<p>开启手机“定位服务”<br/>以便获得更准确的结果</p>
    </div>
    <div class="s_result">
    	<p>北京市海淀区三里河路5号院-西北门</p>
        <p>北京市海淀区三里河路5号院-西北门</p>
        <p>北京市海淀区三里河路5号院-西北门</p>
        <p>北京市海淀区三里河路5号院-西北门</p>
    </div>
</div>

</body>
</html>
