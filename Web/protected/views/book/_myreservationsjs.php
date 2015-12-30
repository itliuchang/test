$(function(){
	$('.p,.u').hammer().on('tap',function(e){
		e.gesture.srcEvent.preventDefault();
		$('.p,.u').toggleClass('selected');
		$('.previous,.upcoming').toggleClass('hide');
	});
	$('.right').hammer().off().on('tap',function(e){
		e.gesture.srcEvent.preventDefault();
		var id = $(this).parents('.option').attr('data-id');
		$('#deleteModal').attr('data-id',id).modal();
	});
	$('#deleteModal .confirm').hammer().off().on('tap',function(e){
		e.gesture.srcEvent.preventDefault();
		$('#deleteModal').modal('hide');
		var resId = $(this).parents('#deleteModal').attr('data-id');
		CHelper.toggleTip('show',resId);
		CHelper.toggleTip('show','fs');
		
	});
});