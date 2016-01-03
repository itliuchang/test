$(function(){
	$('.companyWrapper').hammer().on('tap press',function(e){
		e.gesture.srcEvent.preventDefault();
		var id = $('.companyid').val();
		location.href = '/company/profile-'+id;
	})
});