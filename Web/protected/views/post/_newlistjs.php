$(function(){
	$('.write').hammer().on('tap',function(){
		location.href="/user/logout";
	});
});