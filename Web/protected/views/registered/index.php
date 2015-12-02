<div id="access">
	<div class="banner">
		<ul>
		    <li><img src="/images/403.png"></li>
		    <li><img src="/images/404.png"></li>
		    <li><img src="/images/500.png"></li>
		    <li><img src="/images/51daren.png"></li>
		</ul>
	</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_js', null ,true);
    $cs->registerScript('registered', $js, CClientScript::POS_END);
?>
</div>
