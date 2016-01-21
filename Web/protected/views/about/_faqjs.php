$(function(){
	$('.menubar').hammer().on('tap',function(){
		$('.menu').toggleClass('hide');
	});
	
});