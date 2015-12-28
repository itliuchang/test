$(function() {
	var $banner = $('.banner'),
    $unslider = $banner.unslider({dots:true,}),
    data = $unslider.data('unslider');
    $banner.hammer().on('swiperight panright',function(){
    	data.prev();
    }).on('swipeleft panleft',function(){
    	data.next();
    });
});