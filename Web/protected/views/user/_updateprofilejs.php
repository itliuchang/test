$(function(){
	
	CHelper.uploadOSS(token,{'domain':domain,'browse_button':'selectbackground', 'container':'background_container'},{
		'FileUploaded':function(up,file){
			CHelper.toggleTip('hide');
			
			link = 'http://naked.img-cn-shanghai.aliyuncs.com/img/'+up.id+'@!chang';
			$('.backgroundurl').val(link);
			$('.background').attr('style','background-image:url('+link+')');
		}
	});
	CHelper.uploadOSS(token,{'domain':domain,'browse_button':'selectportrait', 'container':'portrait_container'},{
		'FileUploaded':function(up,file){
			
			CHelper.toggleTip('hide');
			link = 'http://naked.img-cn-shanghai.aliyuncs.com/img/'+up.id+'@!zheng';
			$('#selectportrait').attr('src', link);
		}
	})

	$('.footer').hammer().on('tap press',function(e){
		e.gesture.srcEvent.preventDefault();
		var name = CHelper.filterXSS($('.name').val()),
			title = $('.title').val(),
			website = $('.website').val(),
			background = $('.backgroundurl').val(),
			portrait = $('.portrait').attr('src'),
			birthday = $('.birthday').val(),
			location = $('.location').val(),
			gender = $('.sex').val(),
			description = CHelper.filterXSS($('.description').val()),
			skills = CHelper.filterXSS($('.skills').val()),
			interests = CHelper.filterXSS($('.interests').val()),
			facebook = $('.facebook').val(),
			twitter = $('.twitter').val(),
			linkedin = $('.linkIn').val(),
			instagram = $('.instagram').val(),
			status = $('.status').val();
		if(!name || !title){
			CHelper.toggleTip('show','Please input your name or title','warn',2000);
		} else {
			CHelper.asynRequest('/user/updateprofile',{
				nickName:name,
				title:title,
				website:website,
				background:background,
				portrait:portrait,
				birthday:birthday,
				gender:gender,
				location:location,
				description:description,
				skills:skills,
				interests:interests,
				facebookid:facebook,
				twitterid:twitter,
				linkedinid:linkedin,
				instagramid:instagram,
				status:status,
			},{
				before:function(){
					CHelper.toggleTip('show','commiting...');
				},
				error:function(msg){
					CHelper.toggleTip('show','ERROR','warn',1000);
				},
				success:function(response){
					if($('.footer').hasClass('save')){
						CHelper.toggleTip('show',response.message,'success',1000);
						location.href='/more';
					} else {
						location.href = '/company/updateprofile';
					}
				},
				failure:function(response){
					CHelper.toggleTip('show',response.message,'fail',1000);
				}
			});
		}
		
	});
});