$(function(){
	$('.agree .icon').hammer().on('tap',function(){
		$(this).toggleClass('hasAgree');
	});
	$('.footer').hammer().on('tap',function(){
		callpay();
	});
});