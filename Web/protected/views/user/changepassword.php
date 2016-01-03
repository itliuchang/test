<div id="changepassword">
	<div class="inputOption">
		<input type="text" class='currentpassword' placeholder="Current Password">
	</div>
	<div class="inputOption">
		<input type="password" class='newpassword' placeholder="New Password" class="bborder">
		<input type="password" class='repassword' placeholder="Confirm Password">
	</div>
	<a href="#" class="submit">SUBMIT</a>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_changepasswordjs', null ,true);
    $cs->registerScript('changepassword', $js, CClientScript::POS_END);
?>