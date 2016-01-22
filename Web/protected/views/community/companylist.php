<div id="head" class="community">
	<?php $this->widget('CommunityBarWidget',array('currentTab' => '/community/companylist')) ?>
</div>
<div id="community">
	<div class="companylist pb60">
		<?php foreach($list as $value): ?>
		<div class="option">
			<input type='text' id='<?php echo $value['id'] ?>' hidden>
			<img src="<?php echo $value['logo']?:'/images/company-default.png' ?>" alt="">
			<div class="content">
				<h3><?php echo $value['name'] ?></h3>
				<p><?php echo $value['locationName'] ?></p>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
<div class="container-fluid tbar" id="footer">
    <?php $this->widget('FTBarWidget',array('currentTab' => '/community/serviceslist')) ?>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_servicescompanyjs', null ,true);
    $cs->registerScript('servicescompany', $js, CClientScript::POS_END);
?>