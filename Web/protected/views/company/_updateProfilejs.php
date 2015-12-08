$(function(){
	myscroll=new iScroll("wrapper");
	$('.footer').click(function(){
		$('.servicelist').removeClass('hide');
		myscroll.refresh();
	});
	$('.outer>li>p').click(function(){
		$(this).next('.inner').toggleClass('hide');
		myscroll.refresh();
	});
});