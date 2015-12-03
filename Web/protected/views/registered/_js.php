$(function() {
	var $banner = $('.banner'),
    $unslider = $banner.unslider({dots:true,}),
    data = $unslider.data('unslider');
    $banner.hammer().on('swiperight',function(){
    	data.prev();
    }).on('swiperleft',function(){
    	data.next();
    });
});