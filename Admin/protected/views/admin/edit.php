<div class='page-header'>
	<h1 class='pull-left'>
		<i class='icon-user'></i> <span>管理员-资料编辑</span>
	</h1>
</div>
<input id='action-type'  type='hidden' value='<?php echo $this->action->id ?>'/>
<div class='row-fluid'>
	<div class='span12 box bordered-box blue-border'>
		<div class='box-content box-double-padding'>
			<form id='edit_base_form' action='/admin/editadmin' method='post' class='form' style='margin-bottom: 0;'>
			<input type='hidden' name='id' value='<?php echo $data['id'] ?>'/>
			
			<fieldset>
				<div class='span10'>
					<div class='control-group'>
						<label class='control-label'>管理员名字 <span class='text-red'>*</span></label>
						<div class='controls'>
							<input class='span8' name='name' value='<?php echo $data['name']?>' type='text' data-rule-required='true' data-msg-required='请输入名字'/>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>登陆名 <span class='text-red'>*</span></label>
						<div class='controls'>
							<input class='span8' name='loginName' value='<?php echo $data['loginName']?>' type='text' data-rule-required='true' data-msg-required='请输入登陆名'/>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>登陆密码 <span class='text-red'>*</span></label>
						<div class='controls'>
							<input class='span8' name='password' value='' type='text' data-rule-required='true' data-msg-required='请输入密码'/>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>管理等级</label>
						<div class='controls'>
							<select name='level'>
								<option value="1" <?php if($data['level']==1) echo 'selected'?>>总管理</option>
								<option value="2" <?php if($data['level']==2) echo 'selected'?>>分管理</option>
								<option value="3" <?php if($data['level']==2) echo 'selected'?>>普通管理</option>
							</select>
						</div>
					</div>
				</div>
			</fieldset>
			
			<div style='margin-bottom: 0;'>
				<div class='text-left'>
					<button id='btn-save' class='btn btn-primary' type='submit'> 保存 </button>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>

<?php
    $cs = Yii::app()->clientScript;
    $js = <<<STR
        $(function(){
			$('#edit_base_form').validate({
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
					$('#btn-save').attr('disabled', true);
		
					if($('#action-type').val()=='edit'){
						CHelper.asynRequest('/admin/edit', $('#edit_base_form').serialize(), {
							before: function(xhr){},
							success: function(response){
						        $.jGrowl('修改成功');
						    },
						    failure: function(msg){
						        $.jGrowl('系统异常，请重试');
							},
							error: function(msg){
						        $.jGrowl('系统异常，请重试');
							},
						});
						$('#btn-save').attr('disabled',false);
					} else {
						form.submit();
					}
				}
			});

        });
STR;
    $cs->registerScript('admin-edit', $js, CClientScript::POS_END);
?>

