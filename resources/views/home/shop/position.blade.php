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
    {{--<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script>--}}{{--腾讯地图API--}}
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=BNUjjtFI1Uis61ECHgO1jZvG"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        $(function(){
            wx.config(<?php echo $js->config(array('getLocation', 'openLocation'), true) ?>);
            wx.ready(function () {
               //自动获取位置
                wx.getLocation({
                    success: function (res) {
                        alert(JSON.stringify(res));
                        //地址解析
                        getAddress(res.latitude,res.longitude);
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
                            getAddress(res.latitude,res.longitude);
                        },
                        cancel: function (res) {
                            alert('用户拒绝授权获取地理位置');
                        }
                    });
                });
            });
        });
    </script>
    <script>
        function getAddress(lat,lng)
        {
            var lat = parseFloat(lat);
            var lng = parseFloat(lng);
            // 创建地理编码实例
            var myGeo = new BMap.Geocoder();
            // 根据坐标得到地址描述
            myGeo.getLocation(new BMap.Point(lng, lat), function(result){
                if (result){
                    alert(result.address);
                }
            });
        }


//        var geocoder = null;
//        //地址和经纬度之间进行转换服务
//        geocoder = new qq.maps.Geocoder();
//        function codeLatLng(lat,lng) {
//            //获取经纬度
//            var lat = parseFloat(lat);
//            var lng = parseFloat(lng);
//            var latLng = new qq.maps.LatLng(lat, lng);
//            //对指定经纬度进行解析
//            geocoder.getAddress(latLng);
//            //设置服务请求成功的回调函数
//            geocoder.setComplete(function(result) {
//                alert(result.detail.address);
//            });
//            //若服务请求失败，则运行以下函数
//            geocoder.setError(function() {
//                alert("出错了，请输入正确的经纬度！！！");
//            });
//
//        }
    </script>
</head>

<body>

<div class="wrapper">
	<div class="s_top">
        {!! Html::image('wechat/images/logo.png') !!}<p>4s店查询</p>
    </div>
    <div class="s_position">
    	<a class="s_btn" id="position">重新定位</a>
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
