$(function(){
	$('.footer').click(function(){
		$('.servicelist').removeClass('hide');
	});
	$('.outer>li>p').click(function(){
		$(this).next('.inner').toggleClass('hide');
	});
	myscroll=new iScroll("wrapper");
});