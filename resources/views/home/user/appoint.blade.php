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
        	<form method="get" action="{{ route('api.appointMaintenance') }}">
                <div class="a_form1">
                    <input class="txt01" type="text" data-url="{{ url('shop') }}" value="{{ $name }}" readonly="readonly" placeholder="请选择专营店／输入地址"/>
                    <input type="hidden" name="ou_st_id"  value="{{ $id?$id:0 }}">
                    <div class="txt02">
                        <a href="javascript:;" class="tab tab1 active">保养</a>
                        <a href="javascript:;" class="tab tab2">维修</a>
                    </div>
                    <input type="hidden" class="txt002" name="ou_us_id" value="{{ $user->us_id }}"/>
                    <input type="hidden" class="txt002" name="ou_type" value="保养"/>
                    <input class="txt03" type="text" name="ou_carno" placeholder="请输入车牌号"/>
                    <input class="txt04" type="text" name="ou_name" value="{{ $user->us_name }}" placeholder="请输入姓名"/>
                    <input class="txt05" type="text" name="ou_tel" value="{{ $user->us_tel }}" placeholder="请输入电话"/>
                    <input class="txt07" type="text" name="ou_date" placeholder="{{ date('Y/m/d',time()) }}" onfocus="(this.type='date')" />
                    <textarea class="txt08" name="ou_msg" cols="" rows="">预约留言</textarea>
                    <input name="res" type="reset" style="display:none;" />
                </div>
                <input type="button" name="" value="维修保养" class="txt06 wxby0"/>
            </form>
        </div>
        <div class="a_list a_yysj" style="display: none;">
        	<form method="get" action="{{ route('api.appointTestDrive') }}">
                <div class="a_form2">
                    <input type="hidden" class="txt002" name="od_us_id" value="{{ $user->us_id }}"/>
                    <input class="txt01" type="text" data-url="{{ url('station') }}"  value="{{ $name }}" readonly="readonly" placeholder="请选择专营店／输入地址"/>
                    <input type="hidden" name="od_st_id"  value="{{ $id?$id:0 }}">
                    <select class="txt02" name="od_s_id">
                        <option value="0">选择车系</option>
                        @foreach($series as $sery)
                            <option value="{{ $sery->s_id }}">{{ $sery->s_name }}</option>
                        @endforeach
                    </select>
                    <select class="txt03" name="od_ct_id">
                        <option value="0">选择车型</option>
                    </select>
                    <input class="txt04" type="text" name="od_name" value="{{ $user->us_name }}" placeholder="请输入姓名"/>
                    <input class="txt05" type="text" name="od_tel" value="{{ $user->us_tel }}" placeholder="请输入电话"/>
                    <input class="txt07" type="text" name="od_date" placeholder="2016,4,19" onfocus="(this.type='date')" />
                    <textarea class="txt08" name="od_msg" cols="" rows="">预约留言</textarea>
                    <input name="res" type="reset" style="display:none;" />
                </div>
                <input type="button" name="res" value="预约试驾" class="txt06 wxby0"/>
            </form>

        </div>
    </div>
</div>
<script>
    $('select[name=od_s_id]').change(function(){
        //alert($(this).val());
        var s_id = $(this).val();
        $.ajax({
            url:host+'/api/getCarModels',
            data:{s_id:s_id},
            type:'post',
            success:function(res)
            {
                console.log(res);
                var list = '<option value="0">选择车型</option>';
                $.each(res.models,function(i,v){
                    if (i!=0){

                        list += '<option value="'+ v.id+'">'+ v.models +'</option>';
                    }
                });
                $('select[name=od_ct_id]').html(list);
            },
            dataType:'json'
        });
    });
</script>
</body>
</html>
