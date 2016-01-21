$(function(){
	$('.p,.u').hammer().on('tap',function(e){
		e.gesture.srcEvent.preventDefault();
		$('.p,.u').toggleClass('selected');
		$('.product,.order').toggleClass('hide');
	});
});