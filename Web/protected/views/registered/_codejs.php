$(function(){
	$('.btn_verify').hammer().on('tap',function(){
		if(!$('.wrapper input').val()){
			CHelper.toggleTip('show','Please enter your CDK','error','2000');
		}else{
			CHelper.asynRequest('/codeauth-'+$('.wrapper input').val(),{},{
				before:function(){
					CHelper.toggleTip('show','checking');
				},
				success:function(data){
					CHelper.toggleTip('show','success','success','2000');
					location.href="/registered/access";
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