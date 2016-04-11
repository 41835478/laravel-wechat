jQuery(document).ready(function($){
	//open popup
	function CurentTime()
    { 
        var now = new Date();
        
        var year = now.getFullYear();       //年
        var month = now.getMonth() + 1;     //月
        var day = now.getDate();            //日
        
        var hh = now.getHours();            //时
        var mm = now.getMinutes();          //分
        var ss = now.getSeconds();          //秒
        
        var clock = year + "/";
        
        if(month < 10)
            clock += "0";
        
        clock += month + "/";
        
        if(day < 10)
            clock += "0";
            
        clock += day + " ";
        
        if(hh < 10)
            clock += "0";
            
        clock += hh + ":";
        if (mm < 10) clock += '0'; 
        clock += mm + ":"; 
         
        if (ss < 10) clock += '0'; 
        clock += ss; 
        return(clock); 
	}
	var timer=document.getElementById("fnTimeCountDown").getAttribute("data-end");
    var _token = $('input[name=_token]').val();
    var url = $('#activity').attr("action");
    var event_id = $('input[name=event_id]').val();
    var award_id = $('input[name=award_id]').val();

    if(CurentTime()>=timer){
        $('.djs').html('<p>活动已开始！</p>');
    }
	$('.cd-popup-trigger').on('click', function(event){
        //alert(_token);
		event.preventDefault();
		if(CurentTime()>=timer){
			$.ajax({
				type:'post',
				url:url,
				data:{'_token':_token,'event_id':event_id,'award_id':award_id},
				dataType:'json',
				success : function(data){

                    if(data.status==0){
                        $('p#text').text(data.msg);
                        document.getElementById('cdkey').style.display="none";
                        document.getElementById('text').style.paddingTop="2em";
                        document.getElementById('text').style.paddingBottom="2em";
                    }
					if(data.status==1){
						$('p#text').text(data.msg);
						$('p#cdkey').text('兑奖码：' + data.cdkey);
					}

                    if(data.status==2){
                        $('p#text').text(data.msg);
                        $('p#cdkey').text('兑奖码：' + data.cdkey);
                    }
                    $('.cd-popup').addClass('is-visible');
                }
			})
			
		}else{
            $('p#text').text('活动还没开始哟～');

            $('.cd-popup').addClass('is-visible');
        }
	});
	//close popup
	$('.cd-popup').on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') ) {
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
	});
	//close popup when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$('.cd-popup').removeClass('is-visible');
	    }
    });
});