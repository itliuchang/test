<div id="workspacelist">
	<select class="location">
		<option>New York</option>
	</select>
	<input type="date" id='date' value='<?php echo $date?>' min="<?php echo date('Y-m-d') ?>">
	<?php foreach($data as $value):?>
	<div class="option">
	<input type='hidden' name='id' value='<?php echo $value['id']?>'>
	<input type="hidden" name='seatsLeft' value='0'>
		<div class="imgWrapper">
			<img src="<?php echo $value['picture']?>" alt="">
		</div>
		<div class="content">
			<h3 class="name"><?php echo $value['name']?></h3>
			<div class='seatsLeft'></div>
			<p>available</p>
		</div>
		<div class="footer">BOOK WORKSPACE</div>
	</div>
	<?php endforeach;?>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_workspacelistjs', null ,true);
    $cs->registerScript('workspace', $js, CClientScript::POS_END);
?>