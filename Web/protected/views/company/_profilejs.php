$(function(){

	$('.update').hammer().on('tap press',function(e){
		e.gesture.srcEvent.preventDefault();
		var id = $('input[name="id"]').val();
		if(id){
			location.href='/company/updateprofile-'+id;
		} else {
			location.href = '/company/updateprofile';
		}
		
		
	});
});