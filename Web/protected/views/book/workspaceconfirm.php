<div id="workspaceconfirm">
<input type='hidden' name='id' value='<?php echo $data['id']?>'>
<input type='hidden' name='userId' value='<?php echo Yii::app()->user->id?>'>
	<h2>CONFIRM WORKSPACE RESERVATION</h2>
	<p class="date" min="<?php echo date('Y-m-d') ?>"><?php echo $date?></p>
	<h3><?php echo $data['name']?></h3>
	<p class="address"><?php echo $data['location']?></p>
	<div class="buttonWrapper">
		<a class="confirm">CONFIRM BOOKING</a>
		<a class="cancel">CANCEL</a>
	</div>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_workspaceconfirmjs', null ,true);
    $cs->registerScript('workspace', $js, CClientScript::POS_END);
?>