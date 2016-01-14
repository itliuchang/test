$(function(){
	$('.item').hammer().on('tap',function(){
		$(this).toggleClass('selected');
		$('.item.selected .choosenum .minus').hammer().off().on('tap',function(){
			if($(this).next().text()>1){
				$(this).next().text($(this).next().text()-1);
			}
		});
		$('.item.selected .choosenum .add').hammer().off().on('tap',function(){
			var $item = $(this).parents('.item');
			if($(this).next().text()<parseFloat($item.find('.numleft').text())){
				$(this).prev().text(Number($(this).prev().text())+1);
			}
		});
	});
	$('.item.selected .choosenum .minus').hammer().on('tap',function(){
		if($(this).next().text()>1){
			$(this).next().text($(this).next().text()-1);
		}
	});
	$('.item.selected .choosenum .add').hammer().on('tap',function(){
		var $item = $(this).parents('.item');
		console.log(parseFloat($item.find('.numleft').text()));
		if($(this).next().text()<parseFloat($item.find('.numleft').text())){
			$(this).prev().text(Number($(this).prev().text())+1);
		}
	});
	$('.footer').hammer().on('tap',function(){
		var $selected = $('.selected'),
			type = $selected.find('.productType').val(),
			name = $selected.find('.type').text(),
			num = $selected.find('.value').text(),
			price = $selected.find('.price').text();
			CHelper.asynRequest('/order/createSession',{
				'type' : type,
				'name' : name,
				'price' : price,
				'num' : num,
			},{
				before:function(){
				CHelper.toggleTip('show','ing..','success');
				},
				success:function(){
					location.href='/registered/basicInfo';
				},
				failure:function(d){
					CHelper.toggleTip('show',d.message,'error',2000);
				},
				error:function(d){
					CHelper.toggleTip('show',d.message,'error',2000);
				}
			});
		
	});
});