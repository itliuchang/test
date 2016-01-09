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
			CHelper.toggleTip('show','Please Input Mobile Phone','error',2000);
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
		}, 2000);
		CHelper.asynRequest('/user/sendsms',{mobile:$('.phoneContent input').first().val(),type:'login',parameter:{type:'GET'}},{
			success:function(){
			},
			failure:function(){
				CHelper.toggleTip('show',d.message,'error',2000);
			},
			error:function(){
				CHelper.toggleTip('show','fail','error',2000);
			}
		});
	}
	}//验证码读秒
	$('.footer').hammer().on('tap',function(){
		var bind = 1;
		if(!$('#login .agree .icon.hasAgree')[0]) {
			bind = 0;
		}
	
		var nowClass = $('.now').hasClass('phone')? 'phoneContent' : 'EmailContent';
		if(!$('.'+nowClass+' input').first().val()||!$('.'+nowClass+' input').last().val()){
			CHelper.toggleTip('show','Some Input No Value','error',2000);
		}else if(nowClass == 'phoneContent'){
			var re = /^1\d{10}$/;
			if(!re.test($('.phoneContent input').first().val())){
				CHelper.toggleTip('show','Number Is Wrong','error',2000);
			}else{
				CHelper.asynRequest('/login',{mobile:$('.phoneContent input').first().val(),code:$('.phoneContent input').last().val(),bind:bind,parameter:{type:'GET'}},{
					success:function(){
						location.href='/registered/access';;
					},
					failure:function(d){
						CHelper.toggleTip('show',d.message,'error',2000);
					},
					error:function(d){
						CHelper.toggleTip('show',d.message,'error',2000);
					}
				});
			}
		}else if(nowClass == 'EmailContent'){
			var re = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;
			if(!re.test($('.EmailContent input').first().val())){
				CHelper.toggleTip('show','Email Is Wrong','error',2000);
			}else{
				CHelper.asynRequest('/login',{email:$('.EmailContent input').first().val(),password:$('.EmailContent input').last().val(),bind:bind,parameter:{type:'GET'}},{
					success:function(){
						location.href='/registered/access';
					},
					failure:function(d){
						CHelper.toggleTip('show',d.message,'error',2000);
					},
					error:function(d){
						CHelper.toggleTip('show',d.message,'error',2000);
					}
				});
			}
		}
	});
});