$(function(){
	
	CHelper.uploadOSS(token,{'domain':domain,'browse_button':'selectbackground', 'container':'background_container'},{
		'FileUploaded':function(up,file){
			CHelper.toggleTip('hide');
			
			link = up.settings.url+'/img/'+up.id
			
			$('.background').css('background', 'url('+link+')')
		}
	});
	CHelper.uploadOSS(token,{'domain':domain,'browse_button':'selectportrait', 'container':'portrait_container'},{
		'FileUploaded':function(up,file){
			
			CHelper.toggleTip('hide');
			$('#selectportrait').attr('src', up.settings.url+'/img/'+up.id)
		}
	})

	myscroll=new iScroll("wrapper");
	$('.footer').click(function(){
		$('.servicelist').removeClass('hide');
		myscroll.refresh();
	});
	$('.outer>li>p').click(function(){
		$(this).next('.inner').toggleClass('hide');
		myscroll.refresh();
	});
	$('.x').hammer().on('tap',function(){
		$(this).parent('li').remove();
	});
});