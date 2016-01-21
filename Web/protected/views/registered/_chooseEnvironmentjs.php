$(function(){
	$('.a_code').hammer().on('tap',function(){
		$('.code').toggleClass('hide');
	});
	$('.btn_verify').hammer().on('tap',function(){
		CHelper.asynRequest('/code/check',{'code':$('.code input').val()},{
			before:function(){
				CHelper.toggleTip('show','checking');
			},
			success:function(data){
				CHelper.toggleTip('show','success','success','2000');
				setInterval(location.href="/code-"+data.code, 2000);
			},
			error:function(res){
				CHelper.toggleTip('show','error','error','2000');
			}
		});
	});
});