$(function(){
	$('.p,.u').hammer().on('tap',function(e){
		e.gesture.srcEvent.preventDefault();
		if(!$(this).hasClass('selected')){
			$('.p,.u').toggleClass('selected');
			$('.product,.order').toggleClass('hide');
		}
	});

	$('.a_code').hammer().on('tap',function(){
		$('.code').toggleClass('hide');
	});
	$('.btn_verify').hammer().on('tap',function(){
		if(!$('.footer .code input').val()){
			CHelper.toggleTip('show','Please enter your CDK','error','2000');
		}else{
			CHelper.asynRequest('/codeauth-'+$('.footer .code input').val(),{},{
				before:function(){
					CHelper.toggleTip('show','checking');
				},
				success:function(data){
					var html = template('productTpl',{data:data});
					$('.product').prepend(html);
					CHelper.toggleTip('show','success','success','2000');
				},
				error:function(res){
					CHelper.toggleTip('show','Your CDK is invalid','error','2000');
				},
				failure:function(){
					CHelper.toggleTip('show','Your CDK is invalid','error','2000');
				}
			});
		}
	});
});