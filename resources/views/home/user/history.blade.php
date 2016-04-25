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
<title>油耗历史记录</title>
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
            <p>{{ $user->us_nick }}<span>积分：<i id="point">{{ $user->us_integral }}</i></span></p>
            <div class="c_btn">
                <a href="javascript:;" class="sign">签到</a> | <a href="{{ url('user/userCollection') }}" class="collect">收藏</a>
            </div>
        </div>
    </div>
    
    <div class="h_result">
    	<ul>
            @foreach($user->oilRecords as $record)
        	<li>
                <h2><span><i></i> {{ date('H:i',strtotime($record->o_date)) }}</span><i></i> {{ date('Y-m-d',strtotime($record->o_date)) }}</h2>
                <p>每公升油可以行驶: <span>{{ $record->o_oneoil }}</span> 公里</p>
                <p>每跑一公里需用： <span>{{ $record->o_onekm }}</span> 公升(约等同{{ $record->o_kmmoney*1000 }}cc)的油</p>
                <p>每公里的油钱是： <span>{{ $record->o_kmmoney }}</span> 元</p>
            </li>
            @endforeach
        </ul>
    </div>
    @include('home.user.back')
    
</div>

</body>
</html>
