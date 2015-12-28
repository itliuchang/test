$(function(){
	$('.confirm').hammer().on('tap press',function(e){
		e.gesture.srcEvent.preventDefault();
		var date = $('.date').text(),
			hubId = $('input[name="id"]').val(),
			userId = $('input[name="userId"]').val();
		CHelper.asynRequest('/book/commitconfirm',{
				"date":date,
				"hubId":hubId,
				"userId":userId
			},{
				error:function(){
					CHelper.toggleTip('show','出现错误','warn',1000);
				},
				success:function(){
					CHelper.toggleTip('show','预约成功','success',1000);
					location.href = '/post/newlist';
				}
			});
	})

	$('.cancel').hammer().on('tap press',function(e){
		e.gesture.srcEvent.preventDefault();
		location.href = '/book/workspacelist';
	})
})