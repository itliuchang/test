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
		CHelper.asynRequest('/book/cancel',{id:resId,parameter:{type:'GET'}},{
			before:function(){
				CHelper.toggleTip('show','进行中..','success',1000);
			},
			success:function(){
				$(".upcoming .option[data-id="+resId+"]").remove();
				CHelper.toggleTip('show','cancel success','success',1000);
			},
			failure:function(m){
				CHelper.toggleTip('show',m.message,'fail',1000);
			},
			error:function(e){
				CHelper.toggleTip('show',m.message,'fail',1000);
			}
		});
	});
});