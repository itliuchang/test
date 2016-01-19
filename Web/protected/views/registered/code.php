<div id="code">
	<h2>ACTIVATION CODE</h2>
	<div class="wrapper">
		<input type="text" placeholder="Enter CDK">
		<a class="btn_verify">VERIFY</a>
	</div>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_codejs', null ,true);
    $cs->registerScript('regist', $js, CClientScript::POS_END);
?>