$(function(){
	$('.agree .icon').hammer().on('tap',function(){
		$(this).toggleClass('hasAgree');
	});
	$('.footer').hammer().on('tap',function(){
		if($('.agree .icon').hasClass('hasAgree')){
			callpay();
		}else{
			CHelper.toggleTip('show','同意协议才能支付','fail',1000);
		}
	});
});