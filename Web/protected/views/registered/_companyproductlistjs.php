$(function(){
	// $('.item').hammer().on('tap',function(){
	// 	$(this).toggleClass('selected');
	// 	$('.item.selected .choosenum .minus').hammer().off().on('tap',function(){
	// 		if($(this).next().text()>1){
	// 			$(this).next().text($(this).next().text()-1);
	// 		}
	// 	});
	// 	$('.item.selected .choosenum .add').hammer().off().on('tap',function(){
	// 		var $item = $(this).parents('.item');
	// 		if($(this).prev().text()<parseFloat($item.find('.numleft').text())){
	// 			$(this).prev().text(Number($(this).prev().text())+1);
	// 		}
	// 	});
	// });
	// $('.item.selected .choosenum .minus').hammer().on('tap',function(){
	// 	if($(this).next().text()>1){
	// 		$(this).next().text($(this).next().text()-1);
	// 	}
	// });
	// $('.item.selected .choosenum .add').hammer().on('tap',function(){
	// 	var $item = $(this).parents('.item');
	// 	console.log(parseFloat($item.find('.numleft').text()));
	// 	console.log(Number($(this).prev().text()));
	// 	if(Number($(this).prev().text())<parseFloat($item.find('.numleft').text())){
	// 		$(this).prev().text(Number($(this).prev().text())+1);
	// 	}
	// });
	CHelper.asynRequest('/registered/companyproductlist',null,{
		success:function(data){
			var html = template('productlistTpl',{data:data});
			$('.title2').after(html);
			add();
		}
	});

	var date=$('.date').val(),
		mouth='';

	$('.date').change(function(){
		date = $(this).val();
		mouth = mouth;
		if(mouth){
			CHelper.asynRequest('/registered/companyproductlist',{
				date:date,
				mouth:mouth
			},{
				error:function(msg){
					CHelper.toggleTip('show',msg,'error',2000);
				},
				success:function(data){
					$('#productlist .item').remove();
					
					var html = template('productlistTpl',{data:data});
					$('.title2').after(html);
					add();
				}
			});
		}
	})

	$('.mouth').change(function(){
		mouth = $(this).val();
		date = date;
		if(date){
			CHelper.asynRequest('/registered/companyproductlist',{
				date:date,
				mouth:mouth
			},{
				error:function(msg){
					CHelper.toggleTip('show',msg,'error',2000);
				},
				success:function(data){
					$('#productlist .item').remove();
					var html = template('productlistTpl',{data:data});
					$('.title2').after(html);
					add();
				}
			});
		}
	});

	function add(){
		$('.item').hammer().on('tap',function(){
			$(this).toggleClass('selected');
			$('.item.selected .choosenum .minus').hammer().off().on('tap',function(){
				if($(this).next().text()>1){
					$(this).next().text($(this).next().text()-1);
				}
			});
			$('.item.selected .choosenum .add').hammer().off().on('tap',function(){
				var $item = $(this).parents('.item');
				if($(this).prev().text()<parseFloat($item.find('.numleft').text())){
					$(this).prev().text(Number($(this).prev().text())+1);
				}
			});
		});
	}

	$('.footer').hammer().on('tap',function(){
		var date = $('.date').val(),
			mouth = $('.mouth').val(),
			select = $('.selected').length;
		if(!date || !mouth){
			CHelper.toggleTip('show','You should select date or month','warn',2000);
		} else if(select < 1){
			CHelper.toggleTip('show','You should select product','warn',2000);
		} else {
			var list =[];
			for(var i = 0 ; i< $('.selected').length;i++){
				var a={};
				a.id = $('.selected:eq('+i+') input').val();
				a.num = $('.selected:eq('+i+') .choosenum .value').text();
				list.push(a);
			}
			CHelper.asynRequest('/order/createcompanysession',{list:list,date:date,month:mouth},{
				success:function(e){
					location.href = '/payment/wxpay/jsapi/company';
				},
				error:function(e){
					console.log(e);
				}
			});
		}
	});
	
});