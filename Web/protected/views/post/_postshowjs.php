$(function(){
	if(location.href.indexOf('#1')>0){
		$('.commentContent').focus();
	}
	$('.user').hammer().off().on('tap',function(e){
		e.gesture.srcEvent.preventDefault();
		location.href="/user/profile-"+$(this).attr('data-id');
	});
	listObserve();
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

	$('.send').hammer().on('tap',function(){
		var content = $('.commentContent').val(),
			postId = $('.postWrapper').attr('data-id');
		if(!content){
			CHelper.toggleTip('show','please input something!','','2000');
			return;
		}else{
			content = CHelper.filterXSS(CHelper.removeEmoji(content));
			CHelper.asynRequest('/user/sendcomment',{'postId':postId,'content':content},{
				before:function(){
					CHelper.toggleTip('show','ing..');
				},
				success:function(data){
					$('.comment_num').text(Number($('.comment_num').text())+1);
					var html = template('postCommentTpl', {data: data});
					$('.commentWrapper').append(html);
					CHelper.toggleTip('show','comment success!','success',2000);
					$('.commentContent').val('');
				}
			});
		}
	});
});