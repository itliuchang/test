$(function(){
	$('.agree .icon').hammer().on('tap',function(){
		$(this).toggleClass('hasAgree');
	});
});