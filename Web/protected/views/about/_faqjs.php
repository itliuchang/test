$(function(){
	$('.menubar').hammer().on('tap',function(){
		$('.menu').toggleClass('hide');
	});

	if(!$('.menu').hasClass('hide')){
		$('.menu').addClass('hide');
	}
	
});