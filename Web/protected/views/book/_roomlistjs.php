$(function(){
	var arr = [1,2,7,4,10];
	arr.forEach(function(v){
	$('.piece').eq(v).addClass('selected');
	});
});