<div id="head" class="community">
	<?php $this->widget('CommunityBarWidget',array('currentTab' => '/community/memberlist')) ?>
</div>
<div id="community">
	<div class="memberlist">
		<?php foreach($list as $value): ?>
		<div class="option">
			<input type='text' id='<?php echo $value['id'] ?>' hidden>
			<a href="#"><img src="<?php echo $value['portrait'] ?>" alt=""></a>
			<div class="content">
				<h3 class="overflow-line1"><?php echo $value['nickName'] ?></h3>
				<p class="overflow-line1"><?php echo $value['title'] ?></p>
				<p class="overflow-line1"><?php echo $value['locationName'] ?></p>
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
    $js = $this->renderPartial('_memberlistjs', null ,true);
    $cs->registerScript('memberlistjs', $js, CClientScript::POS_END);
?>