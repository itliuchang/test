<input id='action-type'  type='hidden' value='<?php echo $this->action->id ?>'/>
<div class='row-fluid'>
	<div class='span12 box bordered-box blue-border'>
		<div class='box-content box-double-padding'>
			<form id='edit_base_form' action='/reservation/editinfo' method='post' class='form' style='margin-bottom: 0;'>
			<input type='hidden' name='id' value='<?php echo $data['id'] ?>'/>
			<input type='hidden' name='userId' value='<?php echo $data['userId'] ?>'/>
			
			<fieldset>
				<div class='span10'>
					<div class='control-group'>
						<label class='control-label'>预约类型</label>
						<div class='controls'>
							<select name='type' class="span8">
								<option value="1" <?php if($data['type']==1) echo 'selected=selected'?>>预约座位</option>
								<option value="2" <?php if($data['type']==2) echo 'selected=selected'?>>预约会议室</option>
							</select>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>预约人</label>
						<div class='controls'>
							<input class='span8' name='user' value='<?php echo $data['user']['nickName']?>' type='text'/>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>所属中心</label>
						<div class='controls'>
							<select name="hub">
							<?php foreach($hub as $list):?>
								<option value="<?php echo $list['id']?>" <?php if($list['id']==$data['hubId']) echo 'selected=selected'?>><?php echo $list['name']?></option>
							<?php endforeach;?>
							</select>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>预约时间 </label>
						<div class='controls'>
							<div class='row-fluid'>
								<div class='input-append form_datepicker date'>
									<input readonly data-format='yyyy-MM-dd hh:mm' name="startTime"  value='<?php echo isset($data['startTime'])? $data['startTime']:""?>' type='text' style='width:130px;'/>
									<span class="add-on"><i class="icon-th"></i></span>
								</div>
							</div>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>结束时间 </label>
						<div class='controls'>
							<div class='row-fluid'>
								<div class='input-append form_datepicker date'>
									<input readonly data-format='yyyy-MM-dd hh:mm' name="endTime"  value='<?php echo $data['type']==2? $data['endTime']:""?>' type='text' style='width:130px;'/>
									<span class="add-on"><i class="icon-th"></i></span>
								</div>
							</div>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>会议室名称 </label>
						<div class='controls'>
							<select name="room">
								<option value="">无</option>
								<?php foreach($room as $list): ?>
								<option value="<?php echo $list['id']?>" <?php echo $list['id']==$data['conferenceroomId']?'selected=selected':''?>><?php echo $list['name']?></option>
							<?php endforeach;?>
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
						CHelper.asynRequest('/reservation/edit', $('#edit_base_form').serialize(), {
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

			$('.selectpicker').selectpicker();

			$('.form_datepicker').datetimepicker({
			    language: 'zh-CN',
			    autoclose:true,
			    startDate: new Date(),
			});
        });
STR;
    $cs->registerScript('channel-edit', $js, CClientScript::POS_END);
?>

