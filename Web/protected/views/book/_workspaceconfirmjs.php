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
				failure:function(){
					CHelper.toggleTip('show','已没有剩余座位','warn',1800);
				},
				error:function(){
					CHelper.toggleTip('show','出现错误','warn',1000);
				},
				success:function(){
					CHelper.toggleTip('show','预约成功,2s后跳转','success',2000);
					setInterval(function(){
						location.href = '/post/newlist';
					},2000);
										
				}
			});
	})

	$('.cancel').hammer().on('tap press',function(e){
		e.gesture.srcEvent.preventDefault();
		location.href = '/book/workspacelist';			
	})
})