$(function(){
	$('.p,.u').hammer().on('tap',function(){
		$('.p,.u').toggleClass('selected');
		$('.previous,.upcoming').toggleClass('hide');
	});
});