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
<title>预约</title>
@include('home.user.common')
{!! Html::script('wechat/js/index.js') !!}
</head>

<body>

<div class="wrapper">
	<div class="s_top">
        {!! Html::image('wechat/images/logo.png') !!}
    	<p>预约</p>
    </div>
    <div class="a_tab">
    	<div class="a_tabtop">
        	<a href="javasctipt:;" class="a_tab01 active"><i></i> 保养维修预约</a>
            <a href="javasctipt:;" class="a_tab02"><i></i> 预约试驾</a>
        </div>
        <div class="a_list a_bywx">
        	<form method="get">
                <div class="a_form1">
                    <input class="txt01" type="text" name="" placeholder="请选择专营店／输入地址"/>
                    <div class="txt02"><a href="javascript:;" class="tab tab1 active">保养</a><a href="javascript:;" class="tab tab2">维修</a></div>
                    <input type="hidden" class="txt002" value=""/>
                    <input class="txt03" type="text" name="" placeholder="请输入车牌号"/>
                    <input class="txt04" type="text" name="" placeholder="请输入姓名"/>
                    <input class="txt05" type="text" name="" placeholder="请输入电话"/>
                    <input class="txt07" type="text" name="" placeholder="2016,4,19" onfocus="(this.type='date')" />
                    <textarea class="txt08" name="" cols="" rows="">预约留言</textarea>
                </div>
                <input type="button" name="" value="维修保养" class="txt06 wxby0"/>
            </form>
        </div>
        <div class="a_list a_yysj" style="display: none;">
        	<form method="get">
                <div class="a_form2">
                    <input class="txt01" type="text" name="" placeholder="请选择专营店／输入地址"/>
                    <select class="txt02"><option>选择车系</option></select>
                    <select class="txt03"><option>选择车型</option></select>
                    <input class="txt04" type="text" name="" placeholder="请输入姓名"/>
                    <input class="txt05" type="text" name="" placeholder="请输入电话"/>
                    <input class="txt07" type="text" name="" placeholder="2016,4,19" onfocus="(this.type='date')" />
                    <textarea class="txt08" name="" cols="" rows="">预约留言</textarea>
                </div>
            </form>
        	<input type="button" name="" value="预约试驾" class="txt06 wxby0"/>
        </div>
    </div>
</div>

</body>
</html>
