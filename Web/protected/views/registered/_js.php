$(function() {
	var $banner = $('.banner'),
    $unslider = $banner.unslider({dots:true,}),
    data = $unslider.data('unslider');
    $banner.hammer().on('swipeleft',function(){
    	data.prev();
    });
});