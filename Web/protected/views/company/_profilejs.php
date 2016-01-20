$(function(){
	$('.update').hammer().on('tap press',function(e){
		e.gesture.srcEvent.preventDefault();
		var id = $('input[name="id"]').val();
		if(id){
			location.href='/company/updateprofile-'+id;
		} else {
			location.href = '/company/updateprofile';
		}
	});
	var id = location.href.split('-')[1];
	if(!id){
		id= $('input[name=id]').val(id);
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
        		alert('fail');
        	}
        },
        url: '/company/profile-'+id+'/%(page)s/%(size)s',
        data:{}
	});
	listObserve();
	function listObserve(){
		$('.postWrapper').hammer().off().on('tap',function(){
			var postId = $(this).attr('data-id');
			location.href = '/post/postshow-'+postId;
		});
	}

	$('.memberlist li').each(function(){
		$(this).hammer().on('tap',function(){
			var id = $(this).attr('data-id');
			location.href = '/user/profile-'+id;
		});
	});
});