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
<title>4S店查询</title>
    @include('home.user.common')
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=BNUjjtFI1Uis61ECHgO1jZvG"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        $(function(){
            wx.config(<?php echo $js->config(array('getLocation', 'openLocation'), false) ?>);
            wx.ready(function () {
               //自动获取位置
                wx.getLocation({
                    success: function (res) {
                        //alert(JSON.stringify(res));
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
                            //alert(JSON.stringify(res));
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
            var lat = parseFloat(lat);    //纬度
            var lng = parseFloat(lng);    //经度
            // 创建地理编码实例
            var myGeo = new BMap.Geocoder();
            // 根据坐标得到地址描述
            myGeo.getLocation(new BMap.Point(lng, lat), function(result){
                if (result){
                    //alert(result.address);
                    $('.s_result0').html('<p>'+result.address+'</p>');
                    //请求接口获取附近4s店
                    $.ajax({
                        url:host+'/api/getDistributor',
                        data:{lat:lat,lng:lng},
                        type:'post',
                        success:function(res)
                        {
                            var list = '';

                            if (res.status==200){
                                $.each(res.list,function(i,v){
                                    //获取亮点间距离
                                    var map = new BMap.Map("allmap");
                                    var url = host +'/shop/'+ v.id;
                                    var pointA = new BMap.Point(lng,lat);  // 创建点坐标A--大渡口区
                                    var pointB = new BMap.Point(v.x, v.y);  // 创建点坐标B--江北区
                                    var distance = (map.getDistance(pointA,pointB)/1000).toFixed(2);
                                    res.list[i].distance = distance;
                                });
                                $.each(res.list,function(i,v){

                                    list += '<li>';
                                    list += '<h2><i></i><a href="'+url+'">'+ v.shopname +'</a></h2>';
                                    list += '<p>距离：'+ v.distance +'公里</p>';
                                    list += '<p>电话：'+ v.tel2+'</p>';
                                    list += '<p>地址：'+ v.adress+'</p>';
                                    list += '</li>';
                                });
                                $('.re_result ul').html(list);
                            }else {
                                alert(res.msg);
                            }
                        },
                        dataType:'json'
                    });
                }
            });
        }

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
    <div class="s_result0">

    </div>
    <div class="h_result re_result">
        <ul>
        </ul>
    </div>
</div>

</body>
</html>
