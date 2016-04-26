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
<title>违章查询</title>
    @include('home.user.common')
    {!! Html::script('javascripts/search1.js') !!}
    {!! Html::script('javascripts/search2.js') !!}
</head>
<style>
    #layer {
        position: absolute;
        top: 0;
        left: 0;
        width: 640px;
        height: 100%;
        background: rgba(0,0,0,.8);
        display: none;
    }
    /*2014-12-22 16:20:23 张佳乐改
    修改内容：改了宽高。
    */
    #layer .box {
        position: absolute;
        top: 63%;
        left: 50%;
        width: 580px;
        height: 120px;
        margin: -250px 0 0 -290px;
        background: #fff;
        overflow: hidden;
    }
    /*原始的 违章查询结果的CSS样式*/
    /*#layer .box {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 580px;
        height: 500px;
        margin: -250px 0 0 -290px;
        background: #fff;
        overflow: hidden;
    }*/

    #layer .title {
        background: -webkit-linear-gradient(top,#fff,#ccc);
        height: 70px;
        line-height: 70px;
        width: 550px;
        font-size: 26px;
        padding-left: 30px;
    }

    #layer .title a {
        float: right;
        display: block;
        width: 80px;
        height: 70px;
        text-align: center;
        text-decoration: none;
        color: #bb0000;
    }

    #layer .txt {
        width: 580px;
        height: 430px;
        position: absolute;
        top: 70px;
        left: 0;
        overflow: hidden;
        overflow-y: scroll;
    }

    #layer .txt p {
        margin: 10px 30px;
        font-size: 26px;
    }
    #layer .txt {
        color: #000;
    }
</style>
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
    <form method="get">
    	<div class="i_form">
        	<select class="txt01" id="serachprovince"></select>
            <select class="txt02" id="serachcity"></select>
        	<select class="txt03" id="serachcarno"></select>
            <input class="txt04" id="serachcarno" id="carno" name="" type="text" placeholder="请输入车牌号"/>
            <select class="txt07" id="cartype"><option>请选择车型</option></select>
            <input class="txt08" type="text" id="engno" name="" placeholder="请输入所有发动机号"/>
            <input type="hidden" value="" id="classno" placeholder="请输入车架号">
    	</div>
        
        <input type="button" id="submit" class="txt05 c_carbind" name="" value="违章查询"/>
    </form>
    @include('home.user.back')
    
</div>
<div id="layer">
    <div class="box">
        <div class="title">违章查询结果<a href="javascript:;">×</a></div>

        <div class="txt">

        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        //判断之前是否有绑定车牌号
//        $.get('/personcenter/getcarno', function (msg) {
//            if (msg != null) {
//                var arr = new Array();
//                arr = msg.split('`');
//                $('#id').val(arr[1]);
//                if (arr[0] != '') {
//                    arr[0] = arr[0].substr(2, arr[0].length);
//                    $('#carno').val(arr[0]);
//                }
//            }
//        });

        var sheng = $("#serachprovince");
        var shi = $("#serachcity");
        var types = $("#cartype");
        var chepai = $("#serachcarno");
        var chejia = $("#classno");
        var fadongji = $("#engno");

        for (var i = 0, j = cartypes.length; i < j; i++) {
            types.append($("<option>", { value: cartypes[i].id, text: cartypes[i].car }));
        }

        function bdpai() {
            var city = json[sheng.val()].citys[shi.val()];
            chepai.html("");
            chepai.append($("<option>", { text: city.abbr,value:city.ids }));
            //console.log(city)
            if (city.engine && city.engine == 1) {
                $(".engno").show();
                if (city.engineno == 0) {
                    fadongji.show().attr("placeholder", "请输入所有发动机号");
                } else {
                    fadongji.show().attr("placeholder", "请输入后" + city.engineno + "位发动机号");
                }

            } else {
                $(".engno").hide();
            }
            if (city.classa && city.classa == 1) {
                $(".classno").show();
                if (city.classno == 0) {
                    chejia.show().attr("placeholder", "请输入所有车架号");
                } else {
                    chejia.show().attr("placeholder", "请输入后" + city.classno + "位车架号");
                }

            } else {
                $(".classno").hide();
            }

        }
        function bdshi() {
            var shis = json[sheng.val()];
            shi.html("");
            for (var i = 0, j = shis.citys.length; i < j; i++) {
                shi.append($("<option>", { value: i, text: shis.citys[i].city_name }));
            }
            bdpai();
        }
        for (var item in json) {
            sheng.append($("<option>", { value: item, text: json[item].province }));
        }
        bdshi();
        sheng.change(bdshi);
        shi.change(bdpai());

        $("#layer .title a").on("touchstart", function() {
            $("#layer").hide();
        });
        //查询
        $('#submit').click(function () {
            if ($('#carno').val() == '' || $('#engno').val() == '' || $('#cartype option:selected').val() == '') {
                //return alert('请输入车辆相关信息');
                $("#layer").show().find(".txt").html("<span style='font-size:25px;'>请输入车辆相关信息</span>");
                return;
            }
            var jsondata = {
                dtype: "json",
                city: json[sheng.val()].citys[shi.val()].city_code,
                hphm: $("#carno").val(),
                hpzl: chepai.val(),
                engineno: fadongji.val(),
                classno: chejia.val()
            }
            console.log(jsondata)

            //return;
            url = '{{ url('api/getViolation') }}';
            $.post(url, jsondata, function (msg) {
                console.log(msg)
                $("#layer").show().find(".txt").html("");
                
                if (msg) {
                    if (msg.resultcode != 200) {
                        $("#layer .txt").append("<p>" + msg.reason + "</p>");
                        return;
                    }
                    $("#layer .txt").append("<p>查询车牌：" + msg.result.hphm + "</p>");
                    $("#layer .txt").append("<p>违章记录条数：" + msg.result.lists.length + "</p>");
                    for (var i = 0, j = msg.result.lists.length; i < j; i++) {
                        var searchlist = msg.result.lists[i];
                        $("#layer .txt").append("<p>违章时间：" + searchlist.date + "</p>");
                        $("#layer .txt").append("<p>违章地点：" + searchlist.area + "</p>");
                        $("#layer .txt").append("<p>违章原因：" + searchlist.act + "</p>");
                        $("#layer .txt").append("<p>违章扣分：" + searchlist.fen + "</p>");
                        $("#layer .txt").append("<p>违章罚款：" + searchlist.money + "</p>");
                        if (searchlist.handled == "1") {
                            $("#layer .txt").append("<p>是否处理：已处理</p>");
                        } else {
                            $("#layer .txt").append("<p>是否处理：未处理或未知</p>");
                        }
                    }

                }
                else {
                    $("#layer .txt").append("<p>没有违章信息</p>");
                }
            });
        });



    });

</script>

</body>
</html>
