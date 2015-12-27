<div id="messagelist">
    <?php foreach($data as $item): ?>
		<div class="option">
		    <?php if($item['id2'] == 0): ?>
				<a href="message/" class="link"></a>
				<a href="#"><img src="/images/portrait-default.png" alt=""></a>
			<?php elseif($item['id2'] == Yii::app()->user->id): ?>
			<?php else: ?>
			<?php endif; ?>
			
			<div class="content">
				<h3 class="overflow-line1">naked Retreats</h3>
				<p class="overflow-line1">Hello Chinese members,in case </p>
			</div>
			<p class="time">17h</p>
		</div>
	<?php endforeach; ?>
</div>

<div class="container-fluid tbar" id="footer">
    <?php $this->widget('FTBarWidget',array('currentTab' => '/message/')) ?>
</div>
