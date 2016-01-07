$(function(){
	var today = $('#date').val();
	$('.location').change(function(){
		var id = $('.location').val();
		location.href = '/book/roomlist-'+id;
	});
	for(var i = 0;i < $('.option').length;i++){
		my = eval($('.option:eq('+i+') input[name="my"]').attr("data-my"));
		if(my=='')
		continue;
		my.forEach(function(v){
			$('.option:eq('+i+') .piece').eq(v).addClass('myselected');
		});
	}
		
	for(var i = 0;i < $('.option').length;i++){
		other = eval($('.option:eq('+i+') input[name="other"]').attr("data-other"));
		if(other=='')
		continue;
		other.forEach(function(v){
			$('.option:eq('+i+') .piece').eq(v).addClass('selected');
		});
	}	
		
	$('.option').hammer().on('tap press',function(e){
		e.gesture.srcEvent.preventDefault();
		var id = $(this).children('input[name="id"]').val(),
			hub = $('.location').val(),
			date = $('#date').val();
			date = date.replace(/-/g,'$');
		location.href='/book/roomshow-'+id+'/'+date+'/'+hub;
	});	

	$('#date').change(function() {
		var date = $(this).val();
		if(new Date() < Date.parse(new Date(date.replace(/-/g, "/")))){
			CHelper.asynRequest('/book/roomlist',{
				"date":date,
			},{
				error:function(xhr,msg){
					console.log(xhr)
				},
				success:function(response){					
					$('.option input[name="other"]').attr("data-other",response['other'])
					$('.option input[name="my"]').attr("data-my",response['my'])
					 $('.piece').removeClass('myselected').removeClass('selected');
					 for(var i = 0;i < $('.option').length;i++){
						my = eval(response[i]['my']);
						if(my=='')
						continue;
						my.forEach(function(v){
							$('.option:eq('+i+') .piece').eq(v).addClass('myselected');
						});
					}
		
					for(var i = 0;i < $('.option').length;i++){
						other = eval(response[i]['other']);
						if(other=='')
						continue;
						other.forEach(function(v){
							$('.option:eq('+i+') .piece').eq(v).addClass('selected');
						});
					}
				}
			});
		} else {
			$('#date').val(today);
			CHelper.toggleTip('show','Can not select past time','warn',1200);
		}
		
	});
});