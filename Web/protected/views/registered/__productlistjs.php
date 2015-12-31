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
					CHelper.toggleTip('show',d.message,'error',1000);
				},
				error:function(d){
					CHelper.toggleTip('show',d.message,'error',1000);
				}
			});
		
	});
});