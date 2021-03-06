$(function(){
	$('.act').hammer().on('tap',timing);
	function timing(){
		if(!$('.phone').val()){
			CHelper.toggleTip('show','Please Input Mobile Phone','error',2000);
		}else{
		$(this).hammer().off();
		var that = $(this);
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
		CHelper.asynRequest('/user/sendsms',{mobile:$('.phone').val(),type:'regist',parameter:{type:'GET'}},{
			success:function(){
			},
			failure:function(d){
				CHelper.toggleTip('show',d.message,'error',2000);
				that.hammer().on('tap',timing);
				clearInterval(t);
				$code.addClass('act').text('CODE');
			},
			error:function(){
				CHelper.toggleTip('show','fail','error',2000);
			}
		});
	}
	}//验证码读秒
	
	$('#basicInfo .footer .next').hammer().on('tap',function(){
		if(!$('#basicInfo .name').val()) {
			CHelper.toggleTip('show','Empty full name','error',2000);
			return;
		}
		
		if(!$('#basicInfo .phone').val()) {
			CHelper.toggleTip('show','Empty mobile number.','error',2000);
			return;
		}
		
		if(!$('#basicInfo .codenum').val()) {
			CHelper.toggleTip('show','Empty code.','error',2000);
			return;
		}

		var re = /^1\d{10}$/;
		if(!re.test($('#basicInfo .phone').val())) {
			CHelper.toggleTip('show','Error mobile number.','error',2000);
			return;
		}
		
		if($('#basicInfo .email').val()) {
			if(!$('#basicInfo .password').first().val()) {
				CHelper.toggleTip('show','Empty password.','error',2000);
				return;
			}
			
			if(!$('#basicInfo .password').last().val()) {
				CHelper.toggleTip('show','Empty repeat password.','error',2000);
				return;
			}
			
			if($('#basicInfo .password').first().val() != $('#basicInfo .password').last().val()) {
				CHelper.toggleTip('show','The passwords you entered do not match.','error',2000);
				return;
			}
			if(!CHelper.checkPassword($('#basicInfo .password').first().val())){
				CHelper.toggleTip('show','Your password must be numbers, characters，underlines or the combination of them between 6 to 20 digits.','error',3000);
				return;
			}
			var re = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;
			if(!re.test($('#basicInfo .email').val())) {
				CHelper.toggleTip('show','Error email','error',2000);
				return;
			}
		}
	
		var data = {
			name:$('#basicInfo .name').val(),
			mobile:$('#basicInfo .phone').val(),
			code:$('#basicInfo .codenum').val(),
			email:$('#basicInfo .email').val(),
			password:$('#basicInfo .password').first().val(),
			parameter:{type:'GET'},
		}
	
		CHelper.asynRequest('/user/companyregist', data,{
			before:function(){
				CHelper.toggleTip('show','ing..','success');
			},
			success:function(){
				location.href='/payment/wxpay/jsapi/company';
			},
			failure:function(d){
				CHelper.toggleTip('show',d.message,'error',2000);
			},
			error:function(d){
				CHelper.toggleTip('show',d.message,'error',2000);
			}
		});
	});
});