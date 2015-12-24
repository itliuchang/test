$(function(){
	$('.p,.u').hammer().on('tap',function(){
		$('.p,.u').toggleClass('selected');
		$('.previous,.upcoming').toggleClass('hide');
	});
	$('.right').hammer().on('tap',function(){
		var id = $(this).parents('.option').attr('data-id');
		$('#deleteModal').attr('data-id',id).modal();
	});
	$('#deleteModal .confirm').hammer().on('tap',function(){
		$('#deleteModal').modal('hide');
		var resId = $(this).parents('#deleteModal').attr('data-id');
		CHelper.asynRequest('/book/cancel',{id:resId},{
			before:function(){
				CHelper.toggleTip('show','进行中..');
			},
			success:function(){
				$(".upcoming .option[data-id="+resId+"]").remove();
				CHelper.toggleTip('show','cancel success','success',1000);
			},
			fail:function(m){
				CHelper.toggleTip('show',m.message,'fail',1000);
			}
		});
	});
});