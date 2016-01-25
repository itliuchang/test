<div id="messagelist">
    <?php foreach($data as $item): ?>
		<div class="option">
		    <?php if($item['id2'] == 0): ?>
				<a href="/message/<?php echo $item['id2'] ?>/chat" class="link"></a>
				<a href="/message/<?php echo $item['id2'] ?>/chat">
				  <img src="<?php echo $item['u2portrait']?>" onerror="this.src='/images/account-default.png'" alt="">
				</a>
				<div class="content">
					<h3 class="overflow-line1">系统消息</h3>
					<p class="overflow-line1"><?php echo CHtml::encode($item['lastMsg']) ?></p>
					<?php if($item['ncount']>0): ?>
					<span class="messageNum"><?php echo $item['ncount'] ?></span>
					<?php endif; ?>
				</div>
			<?php elseif($item['id2'] == Yii::app()->user->id): ?>
				<a href="/message/<?php echo $item['id1'] ?>/chat" class="link"></a>
				<a href="/message/<?php echo $item['id1'] ?>/chat">
				  <img src="<?php echo $item['u1portrait']?>" onerror="this.src='/images/account-default.png'" alt="">
				</a>
				<div class="content">
					<h3 class="overflow-line1"><?php echo CHtml::encode($item['u1name']) ?></h3>
					<p class="overflow-line1"><?php echo CHtml::encode($item['lastMsg']) ?></p>
					<?php if($item['ncount']>0): ?>
					<span class="messageNum"><?php echo $item['ncount'] ?></span>
					<?php endif; ?>
				</div>
			<?php else: ?>
				<a href="/message/<?php echo $item['id2'] ?>/chat" class="link"></a>
				<a href="/message/<?php echo $item['id2'] ?>/chat">
				  <img src="<?php echo $item['u2portrait']?>" onerror="this.src='/images/account-default.png'" alt="">
				</a>
				<div class="content">
					<h3 class="overflow-line1"><?php echo CHtml::encode($item['u2name']) ?></h3>
					<p class="overflow-line1"><?php echo CHtml::encode($item['lastMsg']) ?></p>
					<?php if($item['ncount']>0): ?>
					<span class="messageNum"><?php echo $item['ncount'] ?></span>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<?php if($item['id2'] != 0): ?>
			<p class="time"><?php echo CDate::dgm($item['utime']) ?></p>
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
</div>

<div class="container-fluid tbar" id="footer">
    <?php $this->widget('FTBarWidget',array('currentTab' => '/message/')) ?>
</div>

<?php echo $this->renderPartial('_template') ?>
<?php
	$cs = Yii::app()->clientScript;
	$js = $this->renderPartial('_js', null ,true);
	$cs->registerScript('msg_index', $js, CClientScript::POS_END);
?>