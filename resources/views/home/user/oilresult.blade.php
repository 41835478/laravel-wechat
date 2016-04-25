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
<title>油耗计算器结果</title>
    @include('home.user.common')
    {!! Html::script('wechat/js/index.js') !!}
</head>

<body>

<div class="wrapper">
	<div class="c_header">
    	<div class="c_header01">
            @include('home.user.avatar',['path'=>$user->us_portrait])
        </div>
        <div class="c_header02">
            <p>{{ $user->us_nick }}<span>积分：<i>{{ $user->us_integral }}</i></span></p>
            <div class="c_btn">
                <a href="javascript:;" class="sign">签到</a> | <a href="{{ url('user/userCollection') }}" class="collect">收藏</a>
            </div>
        </div>
    </div>
    <form method="get" id="oilform" action="{{ route('api.oilConsumption') }}">
    	<div class="o_form">
            <input type="hidden" name="us_id" value="{{ $user->us_id }}">
        	<input class="txt01" name="journey" type="text" placeholder="请输入公里数"/>
            <input class="txt02" name="fuel" type="text" placeholder="请输入油箱加满几公升"/>
            <input class="txt03" name="price" type="text" placeholder="请输入油价"/>
    	</div>
         <div class="o_tip">
            <p>为使计算结果准确。请务必在加满油的两次之间的里程数计算。</p>
        </div>
        <input class="txt05 calculate" name="" type="button" value="进行计算"/>
        <input name="res" type="reset" style="display:none;" />
    </form>
   
    <a href="javascript:;" class="txt06">查看历史记录</a>
    
    <div class="o_result" id="result" style="display: none;">
    	<h2>油价计算结果</h2>
        <p>每公升油可以行驶: <span id="o_onekm">6.5</span> 公里</p>
		<p>每跑一公里需用： <span id="o_oneoil">0.154</span> 公升(约等同<span id="cc"></span>cc)的油</p>
		<p>每公里的油钱是： <span id="o_kmmoney">0.769</span> 元</p>
    </div>
    <a href="javascript:;" id="reset" class="txt06 c_return">重新计算</a>
    
</div>

</body>
</html>
