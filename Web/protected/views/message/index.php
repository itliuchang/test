<div id="messagelist">
    <?php foreach($data as $item): ?>
		<div class="option">
		    <?php if($item['id2'] == 0): ?>
				<a href="message/0/chat" class="link"></a>
				<a href="javascript:void(0);">
				  <img src="<?php echo $item['u2portrait']?>" onerror="this.src='/images/portrait-default.png'" alt="">
				</a>
				<div class="content">
					<h3 class="overflow-line1"><?php echo '系统消息' ?></h3>
					<p class="overflow-line1"><?php echo CHtml::encode($item['lastMsg']) ?></p>
				</div>
			<?php elseif($item['id2'] == Yii::app()->user->id): ?>
				<a href="message/<?php echo $item['id1'] ?>/chat" class="link"></a>
				<a href="javascript:void(0);">
				  <img src="<?php echo $item['u1portrait']?>" onerror="this.src='/images/portrait-default.png'" alt="">
				</a>
				<div class="content">
					<h3 class="overflow-line1"><?php echo CHtml::encode($item['u1name']) ?></h3>
					<p class="overflow-line1"><?php echo CHtml::encode($item['lastMsg']) ?></p>
				</div>
			<?php else: ?>
				<a href="message/<?php echo $item['id2'] ?>/chat" class="link"></a>
				<a href="javascript:void(0);">
				  <img src="<?php echo $item['u2portrait']?>" onerror="this.src='/images/portrait-default.png'" alt="">
				</a>
				<div class="content">
					<h3 class="overflow-line1"><?php echo CHtml::encode($item['u2name']) ?></h3>
					<p class="overflow-line1"><?php echo CHtml::encode($item['lastMsg']) ?></p>
				</div>
			<?php endif; ?>
			
			<p class="time"><?php echo CDate::dgm($item['utime']) ?></p>
		</div>
	<?php endforeach; ?>
</div>

<div class="container-fluid tbar" id="footer">
    <?php $this->widget('FTBarWidget',array('currentTab' => '/message/')) ?>
</div>
