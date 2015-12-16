$(function(){
	$('.agree .icon').hammer().on('tap',function(){
		$(this).toggleClass('hasAgree');
	});

	$('.phone,.Email').hammer().on('tap',function(){
		$('.Email,.phone').toggleClass('now');
		$('.EmailContent,.phoneContent').toggleClass('hide');
	});
	$('.act').hammer().on('tap',timing);
	function timing(){
		if(!$('.phoneContent input').first().val()){
			CHelper.toggleTip('show','请输入手机号码','error',1000);
		}else{
		$(this).hammer().off();
		var that = $(this);
		$(this)[0].disabled=true;
		var $code = $('.codebutton'),
					time = 60;
		$code.removeClass('act').addClass('timing');
		var t = setInterval(function(){
			if(!time){
				that.hammer().on('tap',timing);
				$code.addClass('act').text('CODE');
				clearInterval(t);
			}else{
				$code.text(time);
				time--;
			}
		}, 1000);
		CHelper.asynRequest('/user/sendsms',{mobile:$('.phoneContent input').first().val(),type:'login',parameter:{type:'GET'}},{
			success:function(){
			},
			error:function(){
				CHelper.toggleTip('show','发送失败请稍候尝试','error',1000);
			}
		});
	}
	}//验证码读秒
	$('.footer').hammer().on('tap',function(){
		var nowClass = $('.now').hasClass('phone')? 'phoneContent' : 'EmailContent';
		if(!$('.'+nowClass+' input').first().val()||!$('.'+nowClass+' input').last().val()){
			CHelper.toggleTip('show','您有未填的选项','error',1000);
		}else if(nowClass == 'phoneContent'){
			var re = /^1\d{10}$/;
			if(!re.test($('.phoneContent input').first().val())){
				CHelper.toggleTip('show','电话号码格式有误','error',1000);
			}else{
				CHelper.asynRequest('/login',{mobile:$('.phoneContent input').first().val(),code:$('.phoneContent input').last().val(),parameter:{type:'GET'}},{
					success:function(){
						location.href='/post/newlist';
					},
					failure:function(d){
						CHelper.toggleTip('show',d.message,'error',1000);
					},
					error:function(d){
						CHelper.toggleTip('show',d.message,'error',1000);
					}
				});
			}
		}else if(nowClass == 'EmailContent'){
			var re = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;
			if(!re.test($('.EmailContent input').first().val())){
				CHelper.toggleTip('show','Email格式有误','error',1000);
			}else{
				CHelper.asynRequest('/login',{email:$('.EmailContent input').first().val(),password:$('.EmailContent input').last().val(),parameter:{type:'GET'}},{
					success:function(){
						location.href='/post/newlist';
					},
					failure:function(d){
						CHelper.toggleTip('show',d.message,'error',1000);
					},
					error:function(d){
						CHelper.toggleTip('show',d.message,'error',1000);
					}
				});
			}
		}
	});
});