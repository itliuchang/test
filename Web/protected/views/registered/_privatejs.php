$(function(){
	$('.footer').hammer().on('tap press',function(e){
		e.gesture.srcEvent.preventDefault();
		var name = CHelper.filterXSS($('.name').val()),
			phone = CHelper.filterXSS($('.phone').val()),
			email = $('.email').val(),
			remail = $('.remail').val(),
			number = $('.number').val(),
			membertype = $('.membertype').val(),
			hub = $('.hub').val();
		if(!name || !phone || !email || !remail || !number || !membertype || !hub){
			CHelper.toggleTip('show','You should input all information','warn',1200);
		} else if(email!=remail){
			CHelper.toggleTip('show','The mail should be the same','warn',1200);
		} else {
			CHelper.asynRequest('/registered/private',{
				name:name,
				phone:phone,
				email:email,
				number:number,
				membertype:membertype,
				hub:hub
			},{
				error:function(msg){
					CHelper.toggleTip('show',msg,'error',1000);
				},
				success:function(response){
					CHelper.toggleTip('show','SUCCESS','success',1200);
					setInterval(function(){
						location.href = '/wechat/index';
					},1200);
					
				}
			});
		}
		
	});
});