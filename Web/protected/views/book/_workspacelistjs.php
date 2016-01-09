$(function(){
	var date = $('#date').val();
	CHelper.asynRequest('/book/workspacelist',{
			"date":date
	},{
		error:function(msg){
			CHelper.toggleTip('show','Please select time again','warn',2000);
		},
		success:function(response){
			// console.log(response)
			var seatsLeft;
			for(var i = 0;i < $('.option').length;i++){
				var seats = $('.option:eq('+i+') input[name="seats"]').val();
				var seatsleft =seats-response['count'][i][0];
				$('.option:eq('+i+') .seatsLeft').html(seatsleft);
			}
		}
	});
	
	$('#date').change(function(){
		var date = $(this).val();
		CHelper.asynRequest('/book/workspacelist',{
			"date":date
		},{
			error:function(msg){
				CHelper.toggleTip('show','ERROR','warn',3000);
			},
			success:function(response){
				// console.log(response)
				for(var i = 0;i < $('.option').length;i++){
					var seats = $('.option:eq('+i+') input[name="seats"]').val();
					var seatsleft =seats-response['count'][i];
					$('.option:eq('+i+') .seatsLeft').html(seatsleft);
				}
			}
		});
	});
	$('.footer').hammer().on('tap press',function(e){
		e.gesture.srcEvent.preventDefault();
		var id = $(this).parent('.option').children('input[name="id"]').val(),
			date = $('#date').val(),
			seatsleft = $('.seatsLeft').text();
		CHelper.asynRequest('/book/workspacelist', {"id":'999',"hub":id,"date":date} ,{
			error:function(msg){
				CHelper.toggleTip('show',msg,'warn',2000);
			},
			success:function(response){
				// console.log(response)
				if(response['num']<=0){
					CHelper.toggleTip('show','You have no times','warn','2000');
				} else if(response['count']>0){
					CHelper.toggleTip('show','On the same day can only choose once','warn',2000);
				}else {
					if(seatsleft<=0){
						CHelper.toggleTip('show','There are no seats left,please select other HUB','warn',2000);
					} else {
						date = date.replace(/-/g,'$');		
						location.href = '/book/workspaceconfirm-' + id +'/'+date;
					}	
				}
			}
		});
			
		
	});
});