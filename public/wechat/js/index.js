
$(function(){
	if($(".collection").length>0){
		myScroll = new iScroll('wrapper3', {hScroll:false,hideScrollbar:false, checkDOMChanges: true });
	}
	if($(".point").length>0){
		myScroll = new iScroll('wrapper2', {hScroll:false,hideScrollbar:false, checkDOMChanges: true });
		myScroll = new iScroll('wrapper', {hScroll:false,hideScrollbar:false, checkDOMChanges: true });
	}
	
	//积分兑换切换
	$(".p_tabtop a").on("touchstart",function(){
		var index=$(this).index();
		$(this).addClass("active").siblings().removeClass("active");
		$(".p_list").hide();
		$(".p_list").eq(index).fadeIn();
	});
	
	//微信预约切换
	$(".a_tabtop a").on("touchstart",function(){
		var index=$(this).index();
		$(this).addClass("active").siblings().removeClass("active");
		$(".a_list").hide();
		$(".a_list").eq(index).fadeIn();
	});
	
	//微信预约切换
	$(".a_form1 .txt02 a").on("touchstart",function(){
		$(this).addClass("active").siblings().removeClass("active");
		
	});
	
	//
	$(".a_form1 .txt07").on("touchstart",function(){
		$(this).focus();
	});
	$(".a_form2 .txt07").on("touchstart",function(){
		$(this).focus();
	});
	
	
});