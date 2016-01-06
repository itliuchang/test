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
				<p class="overflow-line1"><?php echo CHtml::encode($friendTitle) ?>,<?php echo CHtml::encode($friendCompany) ?>,<?php echo CHtml::encode($friendLocation) ?></p>
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
						<p class="date"><?php echo date('m/d', $item['ctime']) ?></p>
					</div>
					<div class="content clearfix">
						<div class="righto"></div>
						<p><?php echo CHtml::encode(strip_tags($item['body'])) ?></p>
					</div>
				</div>
	    	<?php else: ?>
				<div class="item other">
					<div class="imgWrapper">
						<img src="<?php echo $user['portrait'] ?>" onerror="this.src='/images/portrait-default.png'" alt="">
						<p class="date"><?php echo date('m/d', $item['ctime']) ?></p>
					</div>
					<div class="content">
						<div class="lefto"></div>
						<?php if($item['type']==1): ?>
						<a href="/post/postshow-<?php echo $item['data'] ?>"><?php echo CHtml::encode($item['body']) ?></a>
						<?php else: ?>
						<p><?php echo CHtml::encode(strip_tags($item['body'])) ?></p>
						<?php endif; ?>
					</div>
				</div>
	    	<?php endif; ?>
	    <?php endfor; ?>
	</div>

	<?php if($user['id'] != 0): ?>
		<div class="footer">
			<textarea placeholder="Reply" rows="1"></textarea>
			<a class="sendbtn" href="javascript:void(0)">SEND</a>
		</div>
	<?php endif; ?>
</div>

<?php echo $this->renderPartial('_template') ?>
<script type="text/javascript">
	var friendId = '<?php echo $friendId ?>',
	    myportrait = '<?php Yii::app()->user->getState("portrait") ?>',
	    fportrait = '<?php echo $fportrait ?>',
	    appkeyIm = '<?php echo Yii::app()->params["partner"]["emchat"]["appkey"] ?>';
</script>
<?php
	$cs = Yii::app()->clientScript;
	$cs->registerScriptFile("/js/lib/webim/strophe.js", CClientScript::POS_END);
	$cs->registerScriptFile("/js/lib/webim/json2.js", CClientScript::POS_END);
	$cs->registerScriptFile("/js/lib/webim/easemob.im-1.0.7.js", CClientScript::POS_END);
	$js = $this->renderPartial('_showjs', null ,true);
	$cs->registerScript('msg_show', $js, CClientScript::POS_END);
?>