$(function(){
	
	CHelper.uploadOSS(token,{'domain':domain,'browse_button':'selectbackground', 'container':'background_container'},{
		'FileUploaded':function(up,file){
			CHelper.toggleTip('hide');
			
			link = up.settings.url+'/img/'+up.id
			$('.backgroundurl').val(link);
			$('.background').css('background', 'url('+link+')')
		}
	});
	CHelper.uploadOSS(token,{'domain':domain,'browse_button':'selectlogo', 'container':'logo_container'},{
		'FileUploaded':function(up,file){
			
			CHelper.toggleTip('hide');
			$('#selectlogo').attr('src', up.settings.url+'/img/'+up.id)
		}
	})

	$('.footer').hammer().on('tap press',function(e){
		e.gesture.srcEvent.preventDefault();
		var id = $('input[name="id"]').val(),
			name = CHelper.filterXSS($('.name').val()),
			email = $('.email').val(),
			website = $('.website').val(),
			background = $('.backgroundurl').val(),
			logo = $('.logo').attr('src'),
			introduction = CHelper.filterXSS($('.introduction').val()),
			facebook = $('.facebook').val(),
			linkedin = $('.linkIn').val();
		if(!name){
			CHelper.toggleTip('show','名字不能为空','warn',1000);
		} else {
			CHelper.asynRequest('/company/updateprofile',{
				id:id,
				name:name,
				email:email,
				website:website,
				background:background,
				logo:logo,
				introduction:introduction,
				facebookid:facebook,
				linkedinid:linkedin,
			},{
				before:function(){
					CHelper.toggleTip('show','提交中...');
				},
				error:function(msg){
					CHelper.toggleTip('show','ERROR','warn',1000);
				},
				failure:function(response){
					if(response.code==400)
						CHelper.toggleTip('show','名字重复，请选择别的名字','warn',2000);
				},
				success:function(response){
					location.href = '/post/newlist';
				}
			});
		}
		
	});

	
});