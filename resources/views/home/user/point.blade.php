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
<title>积分查询</title>
    @include('home.user.common')
    {!! Html::script('wechat/js/iscroll.js') !!}
    {!! Html::script('wechat/js/index.js') !!}
</head>

<body>

<div class="wrapper point">
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
    <div class="p_tab">
    	<div class="p_tabtop">
        	<a href="javasctipt:;" class="p_tab01 active"><i></i> 积分兑换</a>
            <a href="javasctipt:;" class="p_tab02"><i></i> 积分排行榜</a>
        </div>
        <div class="p_list">
        	<div class="p_listyes"  @if($records=='') style="display: none;" @endif>
            	<div id="wrapper">
                    <div id="scroller">
                        <ul>
                            <li><p><span>积分：<i>1000</i></span>adriana Lima</p></li>
                            <li><p><span>积分：<i>1000</i></span>小马</p></li>
                            <li><p><span>积分：<i>1000</i></span>一往情深</p></li>
                            <li><p><span>积分：<i>1000</i></span>adriana Lima</p></li>
                            <li><p><span>积分：<i>1000</i></span>一往情深</p></li>
                            <li><p><span>积分：<i>1000</i></span>adriana Lima</p></li>
                            <li><p><span>积分：<i>1000</i></span>adriana Lima</p></li>
                            <li><p><span>积分：<i>1000</i></span>一往情深</p></li>
                            <li><p><span>积分：<i>1000</i></span>adriana Lima</p></li>
                        </ul>
                    </div>
                </div>
            </div>

        	<div class="p_listno" @if(!empty($records)) style="display: none;" @endif>
                {!! Html::image('wechat/images/point.png') !!}
            </div>

        </div>
        <div class="p_list" >
        	<div class="p_listyes">
            	<div id="wrapper2">
                    <div id="scroller2">
                        <ul>
                            @foreach($ranking as $rank)
                            <li><p><span>积分：<i>{{ $rank->us_integral }}</i></span>{{ $rank->us_nick }}</p></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('home.user.back')
    
</div>

</body>
</html>
