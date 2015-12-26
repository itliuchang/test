<div id="head" class="community">
	<?php $this->widget('CommunityBarWidget',array('currentTab' => '/community/serviceslist')) ?>
</div>
<div id="community">
	<div class="serviceslist">
		<?php foreach($list as $value): ?>
		<div class="option">
			<input type='text' id='<?php echo $value['id'] ?>' hidden>
			<img src="<?php echo $value['picture'] ?>" alt="">
			<div class="content">
				<h3><?php echo $value['name'] ?></h3>
				<p><?php echo $value['num'] ?> members</p>
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
    $js = $this->renderPartial('_servicelistjs', null ,true);
    $cs->registerScript('servicelist', $js, CClientScript::POS_END);
?>