$(function(){
	$('.submit').hammer().on('tap press',function(e){
		e.gesture.srcEvent.preventDefault();
		var currentpassword = $('.currentpassword').val(),
			newpassword = $('.newpassword').val(),
			repassword = $('.repassword').val();
		if(!newpassword || !repassword){
			CHelper.toggleTip('show','Password can not be empty','warn',2000);
		}else if(newpassword!=repassword){
			CHelper.toggleTip('show','Two passwords must be the same','warn',2000);
		} else if(!CHelper.checkPassword(newpassword)){
			CHelper.toggleTip('show','Your password must be numbers, characters，underlines or the combination of them between 6 to 20 digits.','warn',2000);
		} else {
			CHelper.asynRequest('/user/changepassword',{
				currentpassword:currentpassword,
				newpassword:newpassword
			},{
				error:function(msg){
					CHelper.toggleTip('show',msg,'error',2000);
				},
				success:function(response){
					CHelper.toggleTip('show','SUCCESS','success',2000);
					setInterval(function(){
						location.href = '/more';
					},1800)
				},
				failure:function(response){
					// console.log(response.code)
					if(response.code==500){
						CHelper.toggleTip('show','Old password is incorrect','warn',2000);
					}
				}
			});
		}
	});
});