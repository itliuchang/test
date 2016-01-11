$(function(){
	CHelper.uploadOSS(token,{'domain':domain,'browse_button':'selectimg', 'container':'img_container'},{
		'FileUploaded':function(up,file){console.log(up)
			CHelper.toggleTip('hide');
			link = 'http://naked.img-cn-shanghai.aliyuncs.com/img/'+up.id+'@!test';
			$('.addimage').addClass('hide');
			$('#img_container').append('<div class="imgWrapper"><div class="x"></div><img class="postimg" src="'+link+'"></div>');
			$('.imgWrapper .x').hammer().on('tap press',function(e){
				e.gesture.srcEvent.preventDefault();
				$('.imgWrapper').remove();
				$('.addimage').removeClass('hide');
			})
			$('.addimage').attr('style','background-image:url('+link+')')
		}
	});

	$('.footer').hammer().on('tap press',function(e){
		e.gesture.srcEvent.preventDefault;
		var img = $('.postimg').attr('src'),
			content = CHelper.filterXSS($('.content').val());
		if(!content){
			CHelper.toggleTip('show','The content can not be empty','warn',2000);
		} else {
			CHelper.asynRequest('/post/newpost',{
				img:img,
				content:content
			},{
				before:function(){
					CHelper.toggleTip('show','Creating...','loader');
				},
				error:function(msg){
		           CHelper.toggleTip('show', msg , 'error', 2000);
		        },
		        success:function(){
		          location.href = '/post/newlist';
		        },
			});
		}
	});
});