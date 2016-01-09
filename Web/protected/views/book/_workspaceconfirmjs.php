$(function(){
	$('.confirm').hammer().on('tap press',function(e){
		e.gesture.srcEvent.preventDefault();
		var date = $('.date').text(),
			hubId = $('input[name="id"]').val();
		CHelper.asynRequest('/book/commitconfirm',{
				"date":date,
				"hubId":hubId
			},{
				failure:function(){
					CHelper.toggleTip('show','No remaining seats','warn',2000);
				},
				error:function(){
					CHelper.toggleTip('show','Error','warn',2000);
				},
				success:function(){
					CHelper.toggleTip('show','SUCCESS','success',2000);
					setInterval(function(){
						location.href = '/more';
					},2000);
										
				}
			});
	})

	$('.cancel').hammer().on('tap press',function(e){
		e.gesture.srcEvent.preventDefault();
		location.href = '/book/workspacelist';			
	})
})