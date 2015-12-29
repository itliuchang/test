$(function(){
	var date = $('#date').val();
	CHelper.asynRequest('/book/workspacelist',{
			"date":date
	},{
		error:function(msg){
			CHelper.toggleTip('show','请重新选择时间','warn',3000);
		},
		success:function(response){
			// console.log(response['count'][0][0]['num'])
			var seatsLeft;
			for(var i = 0;i < $('.option').length;i++){
				seatsleft =50-response['count'][i][0]['num'];
				$('.option:eq('+i+') .seatsLeft').html(seatsleft);
				$('.option:eq('+i+') input[name="seatsLeft"]').val(seatsleft);
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
				// console.log(response['count'][0][0]['num'])
				var seatsLeft;
				for(var i = 0;i < $('.option').length;i++){
					seatsleft =50-response['count'][i][0]['num'];
					$('.option:eq('+i+') .seatsLeft').html(seatsleft);
					$('.option:eq('+i+') input[name="seatsLeft"]').val(seatsleft);
				}
			}
		});
	});
	$('.footer').hammer().on('tap press',function(e){
		e.gesture.srcEvent.preventDefault();
		var id = $(this).parent('.option').children('input[name="id"]').val(),
			date = $('#date').val(),
			seatsleft = $('input[name="seatsLeft"]').val();
		CHelper.asynRequest('/book/workspacelist', {"id":'999'} ,{
			error:function(msg){
				CHelper.toggleTip('show',msg,'warn',1000);
			},
			success:function(response){
				// console.log(response)
				if(response['num']<=0){
					CHelper.toggleTip('show','你本月已没有次数','warn','2000');
				} else {
					if(seatsleft<=0){
						CHelper.toggleTip('show','There are no seats left,please select other HUB','warn',1800);
					} else {
						date = date.replace(/-/g,'$');		
						location.href = '/book/workspaceconfirm-' + id +'/'+date;
					}	
				}
			}
		});
			
		
	});
});