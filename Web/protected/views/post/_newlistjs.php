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
        	},
        	fail:function(){
        		alert('fail');
        	}
        },
        url: '/post/newlist/%(page)s/%(size)s',
        data:{}
	});

        $('.write').hammer().on('tap press',function(e){
                e.gesture.srcEvent.preventDefault;
                location.href = '/post/newpost';
        });
});