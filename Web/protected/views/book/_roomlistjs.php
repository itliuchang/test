$(function(){

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
		var id = $(this).children('input[name="id"]').val();

		location.href='/book/roomshow-'+id;
	});	

	$('#date').change(function() {
		var date = $(this).val();
		CHelper.asynRequest('/book/roomlist',{
				"date":date,
			},{
				error:function(xhr,msg){
					console.log(xhr)
				},
				success:function(response){
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
	});
});