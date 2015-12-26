<div id="community" class="nopt">
	<div class="companylist">
		<?php foreach($list as $value): ?>
		<div class="option">
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