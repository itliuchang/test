<div id="newpostlist">
	<div class="postWrapper" data-id="<?php echo $data['post']['id'] ?>">
		<div class="header">
			<img class="user" src="<?php echo $data['post']['portrait'] ?>" alt="" data-id="<?php echo $data['post']['userId'] ?>">
			<h4><?php echo $data['post']['nickName'] ?></h4>
			<p class="title"><?php echo $data['post']['title'] ?></p>
			<p class="companyName"><?php echo $data['post']['companyName'] ?></p>
			<p class="location"><?php echo $data['post']['location'] ?></p>
			<p class="time"><?php echo CDate::dgm($data['post']['createTime']) ?></p>
		</div>
		<p class="content">
			<?php echo Assist::removeXSS(Assist::removeEmoji($data['post']['content'])) ?>
		</p>
		<?php if($data['post']['picture']): ?>
		<img src="<?php echo $data['post']['picture'] ?>" alt="" class="face">
		<?php endif; ?>
		<div class="footerWrapper">
			<p><span class="like_num"><?php echo $data['post']['like_num'] ?></span>like<span class="comment_num"><?php echo $data['post']['comment_num'] ?></span>comment</p>
			<div class="operation">
				<?php if($data['post']['islike']): ?>
				<a class="liked" data-id="<?php echo $data['post']['likeId'] ?>"></a>
				<?php else: ?>
				<a class="like">
				<?php endif; ?>
				<a class="comment">COMMENT</a>
			</div>
		</div>
		<div class="commentWrapper">
			<?php foreach($data['commentlist'] as $value): ?>
			<div class="comment">
				<p class="time"><?php echo CDate::dgm($value['createTime']) ?></p>
				<img class="user" src="<?php echo $value['portrait'] ?>" alt="" data-id="<?php echo $value['userId'] ?>">
				<div class="right">
					<div class="title">
						<h3 class="name"><?php echo $value['nickName'] ?></h3>
						<p class="location"><?php echo $value['title'] ?>,<?php echo $value['companyName'] ?>,<?php echo $value['location'] ?></p>
					</div>
					<p class="content"><?php echo $value['content'] ?></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php if($data['likelist']): ?>
	<h3 class="likepart">Likes</h3>
	<div class="likelist">
	<?php foreach($data['likelist']  as  $value): ?>
		<div class="option">
			<img class="user" src="<?php echo $value['portrait'] ?>" alt="" data-id="<?php echo $value['userId'] ?>">
			<div class="right">
				<h3><?php echo $value['nickName'] ?></h3>
				<p><?php echo $value['title'] ?></p>
				<p><?php echo $value['companyName'] ?>,<?php echo $value['locationName'] ?></p>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
	<?php endif; ?>
	<div class="footer">
		<textarea placeholder="Reply" rows="1" class="commentContent"></textarea>
		<a class="send">POST</a>
	</div>
</div>
<?php echo $this->renderPartial('_template') ?>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_postshowjs', null ,true);
    $cs->registerScript('post', $js, CClientScript::POS_END);
?>