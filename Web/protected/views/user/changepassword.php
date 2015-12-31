<div id="changepassword">
	<div class="inputOption">
		<input type="text" placeholder="Current Password">
	</div>
	<div class="inputOption">
		<input type="password" placeholder="New Password" class="bborder">
		<input type="password" placeholder="Confirm Password">
	</div>
	<a href="#" class="submit">SUBMIT</a>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_changepasswordjs', null ,true);
    $cs->registerScript('changepassword', $js, CClientScript::POS_END);
?>