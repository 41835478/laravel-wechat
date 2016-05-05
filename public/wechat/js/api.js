/**
 * Created by lvdingtao on 16/4/25.
 */
$(function(){
    //首页签到
    $('#sign').click(function () {
        sign(user_id);
    });


    //签到
    $('.sign').click(function () {
        sign(user_id);
    });

    //油耗计算
    $('.calculate').click(function () {
        var data = $('#oilform').serialize(),
            action = $('#oilform').attr('action');
        $.ajax({
            url:action,
            data:data,
            type:'post',
            success:function(res)
            {
                if (res.status==200){
                    $('#result').css('display','block');
                    $('#o_onekm').text(res.info.o_onekm);
                    $('#o_oneoil').text(res.info.o_oneoil);
                    $('#cc').text(res.info.o_oneoil*1000);
                    $('#o_kmmoney').text(res.info.o_kmmoney);
                }else {
                    alert(res.msg);
                }


            },
            dataType:'json'
        });
    });
    //重新计算
    $('#reset').click(function () {
        $("input[name='res']").click();
    });

    //
    //预约
    $('.wxby0').click(function () {
        var data = $(this).parent().serialize(),
            action = $(this).parent().attr('action');
        $.ajax({
            url:action,
            data:data,
            type:'post',
            success:function(res)
            {
                alert(res.msg);
                //$('input[name=res]').click();
            },
            dataType:'json'
        });
        return false;
    });

    //车辆绑定
    //$('#c_carbind').click(function () {
    //    var data = $(this).parent().serialize(),
    //        action = $(this).parent().attr('action');
    //    $.ajax({
    //        url:action,
    //        data:data,
    //        type:'post',
    //        success:function(res)
    //        {
    //            alert(res.msg);
    //            //$('input[name=res]').click();
    //        },
    //        dataType:'json'
    //    });
    //    return false;
    //});

    //$('input[name=ou_st_id]').click(function(){
    //    window.location.href=$(this).data('url');
    //});
    //$('input[name=od_st_id]').click(function(){
    //    window.location.href=$(this).data('url');
    //});

    $('.txt05').click(function(){
        var data = $(this).parent().serialize(),
            action = $(this).parent().attr('action');
        $.ajax({
            url:action,
            data:data,
            type:'post',
            success:function(res)
            {
                alert(res.msg);
                //$('input[name=res]').click();
            },
            dataType:'json'
        });
        return false;
    });
});


function sign(user_id){
    $.ajax({
        url:host+'/api/makeSign',
        data:{i_us_id:user_id},
        type:'post',
        success:function(res)
        {
            if (res.status==200){
                $('#point').text(res.us_integral);
                alert(res.msg);
            }else {
                alert(res.msg);
            }
        },
        dataType:'json'
    });
}