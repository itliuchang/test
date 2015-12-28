<div id="messageshow">
	<div class="header">
	    <?php if($user['id'] == 0): ?>
			<a href="javascript:void(0)" _id="<?php echo $user['id'] ?>" _name="系统消息" _portrait="<?php echo $user['portrait']?>">
				<img src="<?php echo $user['portrait'] ?>" onerror="this.src='/images/portrait-default.png'" alt="">
			</a>
			<div class="content">
				<h3 class="overflow-line1">系统消息</h3>
				<p class="overflow-line1">Hubapp Administrator</p>
			</div>
		<?php else: ?>
			<a href="javascript:void(0)" _id="<?php echo $user->id ?>" _name="<?php echo CHtml::encode($user->nickName) ?>" _portrait="<?php echo $user->portrait ?>">
				<img src="<?php echo $user->portrait ?>" onerror="this.src='/images/portrait-default.png'" alt="">
			</a>
			<div class="content">
				<h3 class="overflow-line1"><?php echo CHtml::encode($user->nickName) ?></h3>
				<p class="overflow-line1"><?php echo CHtml::encode($user->company) ?></p>
			</div>
		<?php endif; ?>
	</div>

	<div class="wrapper">
	    <?php for($i = count($data) - 1; $i >= 0; $i--): ?>
	    	<?php $item = $data[$i]; ?>
	    	<?php if($item['senderID'] == Yii::app()->user->id): ?>
				<div class="item my">
					<div class="imgWrapper">
						<img src="<?php Yii::app()->user->getState('portrait') ?>" onerror="this.src='/images/portrait-default.png'" alt="">
						<p class="date"><?php echo date('y/m/d', $item['ctime']) ?></p>
					</div>
					<div class="content">
						<div class="righto"></div>
						<p><?php echo CHtml::encode($item['body']) ?></p>
					</div>
				</div>
	    	<?php else: ?>
				<div class="item other">
					<div class="imgWrapper">
						<img src="<?php echo $user['portrait'] ?>" onerror="this.src='/images/portrait-default.png'" alt="">
						<p class="date"><?php echo date('y/m/d', $item['ctime']) ?></p>
					</div>
					<div class="content">
						<div class="lefto"></div>
						<p><?php echo CHtml::encode($item['body']) ?></p>
					</div>
				</div>
	    	<?php endif; ?>
	    <?php endfor; ?>
	</div>

	<?php if($user['id'] != 0): ?>
		<div class="footer">
			<textarea placeholder="Reply" rows="1"></textarea>
			<a href="javascript:void(0)">SEND</a>
		</div>
	<?php endif; ?>
</div>

<?php echo $this->renderPartial('_template') ?>
<script type="text/javascript">
	var friendId = '<?php echo $friendId ?>',
	    myportrait = '<?php Yii::app()->user->getState("portrait") ?>';
</script>
<?php
	$cs = Yii::app()->clientScript;
	$js = $this->renderPartial('_showjs', null ,true);
	$cs->registerScript('msg_show', $js, CClientScript::POS_END);
?>