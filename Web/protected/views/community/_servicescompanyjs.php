$(function(){
	$('.option').hammer().on('tap',function(){
		var id = $(this).find('input').attr('id');
		location.href = '/company/profile-'+id;
	});
});