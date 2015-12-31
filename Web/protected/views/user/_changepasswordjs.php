$(function(){
	$('.submit').hammer().on('tap press',function(e){
		e.gesture.srcEvent.preventDefault();
	});
});