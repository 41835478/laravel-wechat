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
<title>维修站定位</title>
    @include('home.user.common')
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=BNUjjtFI1Uis61ECHgO1jZvG"></script>

</head>

<body>

<div class="wrapper">
	<div class="re_map">
    	<img src="images/map.jpg"/>
    </div>
    <div class="h_result re_result">
    	<ul>
        	<li>
                <h2>{{ $shop->shopname }}</h2>
                <p>地址：{{ $shop->adress }}</p>
            </li>
            
        </ul>
    </div>
    <div class="re_tel">
    	<p>紧急救援：{{ $shop->tel1 }}</p>
    </div>
    <a href="{{ url('user/appointment') }}" class="txt06 c_return">预约维修</a>
</div>
<script>
    //地图
    var map = new BMap.Map("allmap");
    var x = '{{ $shop->x }}',
            y= '{{ $shop->y }}';
    var point = new BMap.Point(x, y);
    map.centerAndZoom(point, 11);
    addMarker(point);
    add_control();

    // 编写自定义函数,创建标注
    function addMarker(point){
        var marker = new BMap.Marker(point);
        map.addOverlay(marker);
    }
</script>
</body>
</html>
