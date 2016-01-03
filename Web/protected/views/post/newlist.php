<div id="newpostlist">
	<?php foreach($list as $value): ?>
	<div class="postWrapper">
		<div class="header">
			<img src="<?php echo $value['portrait'] ?>" alt="">
			<h4><?php echo $value['nickName'] ?></h4>
			<p class="title"><?php echo $value['title'] ?></p>
			<p class="companyName"><?php echo $value['companyName'] ?></p>
			<p class="location"><?php echo $value['location'] ?></p>
			<p class="time"><?php echo CDate::dgm($value['createTime']) ?></p>
		</div>
		<p class="content">
			<?php echo Assist::removeXSS(Assist::removeEmoji($value['content'])) ?>
		</p>
		<?php if($value['picture']): ?>
		<img src="<?php echo $value['picture'] ?>" alt="" class="face">
		<?php endif; ?>
		<div class="footerWrapper">
			<p><span><?php echo $value['like_num'] ?></span>like<span><?php echo $value['comment_num'] ?></span>comment</p>
			<div class="operation"><a href="">LIKE</a><a href="">COMMENT</a></div>
		</div>
	</div>
	<?php endforeach; ?>
	<div class="write"></div>
</div>
<div class="container-fluid tbar" id="footer">
    <?php $this->widget('FTBarWidget',array('currentTab' => '/post/newlist')) ?>
</div>
<?php echo $this->renderPartial('_template') ?>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_newlistjs', null ,true);
    $cs->registerScript('post', $js, CClientScript::POS_END);
?>