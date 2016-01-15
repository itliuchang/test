<div id="productlist">
	<h2 class="title">
		CHOOSE MEMBERSHIP
	</h2>
	<div class="datewrapper">
		<div class="left">
			<input type="date" class="date" value='<?php echo $date?>'>
		</div>
		<div class="right">
			<select class='mouth'>
				<option selected value=''>choose months</option>
				<option value='1'>1</option>
				<option value='2'>2</option>
				<option value='3'>3</option>
				<option value='4'>4</option>
				<option value='5'>5</option>
				<option value='6'>6</option>
			</select>
		</div>
	</div>
	<h2 class="title2">NEAREST AVAILABLE</h2>
	
	<a class="footer">NEXT</a>
</div>
<?php echo $this->renderPartial('_template')?>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_companyproductlistjs', null ,true);
    $cs->registerScript('registered', $js, CClientScript::POS_END);
?>