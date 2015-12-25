<input id='active-action-type'  type='hidden' value='<?php echo $this->action->id ?>'/>
<div class='row-fluid'>
	<div class='span12 box bordered-box blue-border'>
		<div class='box-content box-double-padding'>
			<form id='edit_active_form' action='/route/editproduct' method='post' class='form' style='margin-bottom: 0;'>
			<input type='hidden' name='id' value='<?php echo $data['id'] ?>'/>

			<fieldset>
				<div class='span10'>
					<div class='control-group'>
						<label class='control-label'>产品名称  <span class='text-red'>*</span></label>
						<div class='controls'>
							<input class='span5' name='name' value='<?php echo $data['name']?>' data-rule-required='true' type='text' data-msg-required='请输入产品名称' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>产品价格/月 </label>
						<div class='controls'>
							<input class='span3' name='price' value='<?php echo $data['price']?>' type='number' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>产品次数/月 </label>
						<div class='controls'>
							<input class='span3' name='times' value='<?php echo $data['times']?>' type='number' />
						</div>
					</div>
				</div>
			</fieldset>

			<div style='margin-bottom: 0;'>
				<div class='text-left'>
					<button id='btn-save-active' class='btn btn-primary' type='submit'>保存</button>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>

<?php
	$cs = Yii::app()->clientScript;
	$js = $this->renderPartial('_js_edit_active', null ,true);
	$cs->registerScript('active-edit', $js, CClientScript::POS_END);
?>
