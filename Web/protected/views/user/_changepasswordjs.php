$(function(){
	$('.submit').hammer().on('tap press',function(e){
		e.gesture.srcEvent.preventDefault();
		var currentpassword = $('.currentpassword').val(),
			newpassword = $('.newpassword').val(),
			repassword = $('.repassword').val();
		if(!newpassword || !repassword){
			CHelper.toggleTip('show','Password can not be empty','warn',1200);
		}else if(newpassword!=repassword){
			CHelper.toggleTip('show','Two passwords must be the same','warn',1200);
		} else if(newpassword.length<3 || newpassword.length>16){
			CHelper.toggleTip('show','Password length between 3 to 16','warn',1200);
		} else {
			CHelper.asynRequest('/user/changepassword',{
				currentpassword:currentpassword,
				newpassword:newpassword
			},{
				error:function(msg){
					CHelper.toggleTip('show',msg,'error',1000);
				},
				success:function(response){
					CHelper.toggleTip('show','SUCCESS','success',1200);
					setInterval(function(){
						location.href = '/more';
					},1800)
				},
				failure:function(response){
					// console.log(response.code)
					if(response.code==500){
						CHelper.toggleTip('show','Old password is incorrect','warn',1200);
					}
				}
			});
		}
	});
});