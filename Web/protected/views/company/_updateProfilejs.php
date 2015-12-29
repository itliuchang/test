$(function(){
	$('.serviceWrapper >ul >li').each(function(){
		var id = $(this).attr('data-id');
		$(".servicelist .inner>li[data-id="+id+"]").toggleClass('selected');
	});
	$('.servicelist>.outer>li>p').hammer().on('tap',function(){
		$(this).toggleClass('open');
	});
	$('.servicelist>.outer>li>.inner>li').hammer().on('tap',function(){
		$(this).toggleClass('selected');
	});
	$('.servicelist .cancel').hammer().on('tap',function(){
		$('.servicelist').toggleClass('hide');
	});
	$('.servicelist .ok').hammer().on('tap',function(){
		$ul = $('.serviceWrapper>ul');
		$ul.empty();
		$('.selected').each(function(){
			$ul.append("<li data-id='"+$(this).attr('data-id')+"'><span>"+$(this).text()+"</span><span class='x'>X</span></li>");
		});
		$('.servicelist').toggleClass('hide');
		$('.x').hammer().off().on('tap',function(){
		var id = $(this).parent('li').attr('data-id');
		$(".servicelist .outer>li .inner li[data-id="+id+"]").removeClass('selected');
		$(this).parent('li').remove();
	});
	});
	CHelper.uploadOSS(token,{'domain':domain,'browse_button':'selectbackground', 'container':'background_container'},{
		'FileUploaded':function(up,file){
			CHelper.toggleTip('hide');
			
			link = 'http://naked.img-cn-shanghai.aliyuncs.com/img/'+up.id+'@!chang'
			$('.backgroundurl').val(link);
			$('.background').attr('style','background-image:url('+link+')');
		}
	});
	CHelper.uploadOSS(token,{'domain':domain,'browse_button':'selectlogo', 'container':'logo_container'},{
		'FileUploaded':function(up,file){
			
			CHelper.toggleTip('hide');
			link = 'http://naked.img-cn-shanghai.aliyuncs.com/img/'+up.id+'@!zheng';
			$('#selectlogo').attr('src', link);
		}
	});
		myscroll=new iScroll("wrapper");
	$('.addService .button').click(function(){
		$('.servicelist').removeClass('hide');
		myscroll.refresh();
	});
	$('.outer>li>p').click(function(){
		$(this).next('.inner').toggleClass('hide');
		myscroll.refresh();
	});
	$('.x').hammer().on('tap',function(){
		var id = $(this).parent('li').attr('data-id');
		$(".servicelist .outer>li .inner li[data-id="+id+"]").removeClass('selected');
		$(this).parent('li').remove();
	});
	$('.footer').hammer().on('tap press',function(e){
		e.gesture.srcEvent.preventDefault();
		var id = $('input[name="id"]').val(),
			name = CHelper.filterXSS($('.name').val()),
			phone = $('.phone').val(),
			email = $('.email').val(),
			website = $('.website').val(),
			background = $('.backgroundurl').val(),
			logo = $('.portrait').attr('src'),
			introduction = CHelper.filterXSS($('.introduction').val()),
			facebook = $('.facebook').val(),
			linkedin = $('.linkIn').val(),
			status = $('.status').val();
		if(!name){
			CHelper.toggleTip('show','Please input company name','warn',1000);
		} else {
			var arr = Array();
			$('.serviceWrapper li').each(function(index){
				arr.push($(this).attr('data-id'));
			})
			CHelper.asynRequest('/company/updateprofile',{
				id:id,
				name:name,
				phone:phone,
				email:email,
				website:website,
				background:background,
				logo:logo,
				introduction:introduction,
				service:arr,
				facebookid:facebook,
				linkedinid:linkedin,
			},{
				before:function(){
					CHelper.toggleTip('show','提交中...');
				},
				error:function(msg,response){
					// console.log(response)
					CHelper.toggleTip('show','ERROR','warn',1000);
				},
				failure:function(response){
					if(response.code==400)
						CHelper.toggleTip('show','名字重复，请选择别的名字','warn',2000);
				},
				success:function(response){
					// console.log(response['status'])
					if(response['status'] == 2){
						location.href = '/post/newlist';
					} else {
						location.href = '/more';
					}
				}
			});
		}
	});
});