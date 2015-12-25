$(function(){
	$('#edit_active_form').validate({
        focusInvalid: true,
        onfocusout: function(element){ 
          	$(element).valid(); 
		},
    	onkeyup: function(element){ 
    		$(element).valid(); 
		},
        errorPlacement: function(error, element) {
        	element.parent().parent().addClass('error');
        },
        success: function(callback, element) {
			$(element).parent().parent().removeClass('error');
		},
		submitHandler: function(form){
			$('#btn-save-active').attr('disabled',true);
			
			if($('#active-action-type').val()=='edit'){
				CHelper.asynRequest('/route/edit', $('#edit_active_form').serialize(), {
					before: function(xhr){},
					success: function(response){
						$('#btn-save-active').attr('disabled',false);
				        $.jGrowl('修改成功');
				    },
				    failure: function(msg){
				    	$('#btn-save-active').attr('disabled',false);
				        $.jGrowl('系统异常，请重试');
					},
					error: function(msg){
				    	$('#btn-save-active').attr('disabled',false);
				        $.jGrowl('发现错误');
					},
				});
			} else {
				form.submit();
			}
		}
	});

});