$(function(){
	$('.item').hammer().on('tap',function(){
		$('.item').removeClass('selected');
		$(this).addClass('selected');
		$('.item.selected .choosenum .minus').hammer().off().on('tap',function(){
			if($(this).next().text()>1){
				$(this).next().text($(this).next().text()-1);
			}
		});
		$('.item.selected .choosenum .add').hammer().off().on('tap',function(){
				$(this).prev().text(Number($(this).prev().text())+1);
		});
	});
	$('.item.selected .choosenum .minus').hammer().on('tap',function(){
		if($(this).next().text()>1){
			$(this).next().text($(this).next().text()-1);
		}
	});
	$('.item.selected .choosenum .add').hammer().on('tap',function(){
			$(this).prev().text(Number($(this).prev().text())+1);
	});
});