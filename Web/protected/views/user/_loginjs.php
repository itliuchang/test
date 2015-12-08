$(function(){
	$('.phone,.Email').hammer().on('tap',function(){
		$('.Email,.phone').toggleClass('now');
		$('.EmailContent,.phoneContent').toggleClass('hide');
	});
});