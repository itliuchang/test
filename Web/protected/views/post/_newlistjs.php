$(function(){
	$.infinitScroll({
		container: '#newpostlist',
        item: '.postWrapper',
        perPage :2 ,
        distance:60,
        callbacks: {
        	before:function(){
        		$('#newpostlist').append('<div class="loading"></div>');
        	},
        	success:function(response){
        		$('#newpostlist .loading').remove();
        		var html = template('postlistTpl', {data: response.data.list});
        		$('#newpostlist').append(html);
        		listObserve();
        	},
        	fail:function(){
        		alert('fail');
        	}
        },
        url: '/post/newlist/%(page)s/%(size)s',
        data:{}
	});
	function listObserve(){
		$('.like').hammer().off().on('tap',function(){
			$(this).off();
			var postId = $(this).parents('.postWrapper').attr('data-id');
			CHelper.asynRequest('/user/like-'+postId,{},{
				success:function(data){
					var $like = $('.postWrapper[data-id='+data['postId']+']');
					$like.find('.like').removeClass('like').toggleClass('liked').attr('data-id',data.id);
					$like.find('.like_num').text(Number($like.find('.like_num').text())+1);
					listObserve();
				},
				fail:function(){
					alert('fail');
				}
			});
		});

		$('.liked').hammer().off().on('tap',function(){
			$(this).off();
			var id = $(this).attr('data-id');
			CHelper.asynRequest('/user/liked-'+id,{},{
				success:function(data){
					var $liked = $('.postWrapper[data-id='+data['postId']+']');
					$liked.find('.liked').removeClass('liked').toggleClass('like');
					$liked.find('.like_num').text(Number($liked.find('.like_num').text())-1);
					listObserve();
				},
				fail:function(){
					alert('fail');
				}
			});
		});
	}
	listObserve();
        $('.write').hammer().on('tap press',function(e){
                e.gesture.srcEvent.preventDefault;
                location.href = '/post/newpost';
        });
});