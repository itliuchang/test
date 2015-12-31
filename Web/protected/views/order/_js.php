$(function(){
	$('.agree .icon').hammer().on('tap',function(){
		$(this).toggleClass('hasAgree');
	});
	$('.footer').hammer().on('tap',function(){
		if($('.agree .icon').hasClass('hasAgree')){
			callpay();
		}else{
			CHelper.toggleTip('show','Consent agreement to pay','fail',1000);
		}
	});
});