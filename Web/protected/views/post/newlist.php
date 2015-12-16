<div id="newpostlist">
	<div class="postWrapper">
		<div class="header">
			<img src="/images/portrait-default.png" alt="">
			<span class="time"></span>
			<h4>naked Retreats</h4>
			<p class="title">title</p>
			<p class="companyName">companyName</p>
			<p class="location">location</p>
			<p class="time">17h</p>
		</div>
		<p class="content">
			Membership at naked Hub offers individual the benefits of corporate work with 21st century freedom.
		</p>
		<img src="/images/banner/1.jpg" alt="" class="face">
		<div class="footerWrapper">
			<p><span>3</span>like<span>5</span>comment</p>
			<div class="operation"><a href="">LIKE</a><a href="">COMMENT</a></div>
		</div>
	</div>
	<div class="postWrapper">
		<div class="header">
			<img src="/images/portrait-default.png" alt="">
			<span class="time"></span>
			<h4>naked Retreats</h4>
			<p class="title">title</p>
			<p class="companyName">companyName</p>
			<p class="location">location</p>
		</div>
		<p class="content">
			Membership at naked Hub offers individual the benefits of corporate work with 21st century freedom.
		</p>
		<img src="/images/banner/1.jpg" alt="" class="face">
		<div class="footerWrapper">
			<p><span>3</span>like<span>5</span>comment</p>
			<div class="operation"><a href="">LIKE</a><a href="">COMMENT</a></div>
		</div>
	</div>
	<div class="write"></div>
</div>
<div class="container-fluid tbar" id="footer">
    <?php $this->widget('FTBarWidget') ?>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_newlistjs', null ,true);
    $cs->registerScript('post', $js, CClientScript::POS_END);
?>