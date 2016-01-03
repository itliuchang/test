<div id="newpost">
	<textarea class='content' placeholder="What do you need?Ask the community." rows="7"></textarea>
	<div id='img_container'>
		<p class="addimage" id='selectimg'></p>
	</div>
	<a href="#" class='footer'>SUBMIT</a>
</div>
<script type="text/javascript">
	var domain = '<?php echo Assist::getOSSToken()['domain'] ?>',
    	token = '<?php echo Assist::getOSSToken()['uptoken']?>';
    	token = eval('(' + token + ')')
</script>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_newpostjs', null ,true);
    $cs->registerScript('post', $js, CClientScript::POS_END);
?>