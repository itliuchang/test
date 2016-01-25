$(function(){
	$('.companyWrapper').hammer().on('tap press',function(e){
		e.gesture.srcEvent.preventDefault();
		var id = $('.companyid').val();
		if(id){
			location.href = '/company/profile-'+id;
		}
	});
	var id = location.href.split('-')[1];
	if(!id){
		id= systemVar.uid;
	}
	$.infinitScroll({
		container: '.postlist',
        item: '.postWrapper',
        perPage :2 ,
        distance:60,
        callbacks: {
        	before:function(){
        		$('.postlist').append('<div class="loading"></div>');
        	},
        	success:function(response){
        		$('.postlist .loading').remove();
        		var html = template('postlistTpl', {data: response.data.list});
        		$('.postlist').append(html);
        		listObserve();
        	},
        	fail:function(){
        		CHelper.toggleTip('show','Connection error! Please check your Internet connection and retry!','error','2000');
        		$('.postlist .loading').remove();
        	},
        	error:function(){
        		CHelper.toggleTip('show','Connection error! Please check your Internet connection and retry!','error','2000');
        		$('.postlist .loading').remove();
        	}
        },
        url: '/user/profile-'+id+'/%(page)s/%(size)s',
        data:{}
	});
	listObserve();
	function listObserve(){
		$('.postWrapper').hammer().off().on('tap',function(){
			var postId = $(this).attr('data-id');
			location.href = '/post/postshow-'+postId;
		});
	}
});