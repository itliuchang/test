<div id="community" class="nopt">
	<div class="companylist">
		<?php foreach($list as $value): ?>
		<div class="option">
			<input type='text' id='<?php echo $value['id'] ?>' hidden>
			<img src="<?php echo $value['logo'] ?>" alt="">
			<div class="content">
				<h3><?php echo $value['name'] ?></h3>
				<p><?php echo $value['locationName'] ?></p>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
<div class="container-fluid tbar" id="footer">
    <?php $this->widget('FTBarWidget',array('currentTab' => '/community/companylist')) ?>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_servicescompanyjs', null ,true);
    $cs->registerScript('servicescompany', $js, CClientScript::POS_END);
?>