<div id="messagelist">
    <?php foreach($data as $item): ?>
		<div class="option">
			<a href="message/" class="link"></a>
			<a href="#"><img src="/images/portrait-default.png" alt=""></a>
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
