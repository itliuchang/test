$(function(){
	

	for(var i = 0;i < $('.option').length;i++){
		my = eval($('.option:eq('+i+') input[name="my"]').attr("data-my"));
		if(my=='')
		continue;
		my.forEach(function(v){
			$('.option:eq('+i+') .piece').eq(v).addClass('selected');
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

	
});