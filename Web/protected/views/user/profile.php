<div id="profile">
	<div class="top">
		<div class="background">
			<?php if($user['background']): ?>
			<img src="<?php echo $user['background'] ?>"/>
			<?php endif; ?>
			<?php if($user['id']==Yii::app()->user->id): ?>
			<a href="/user/updateprofile"><div class="update"></div></a>
			<?php endif; ?>
		</div>
		<div class="wrapperPortrait">
			<img class="portrait" src='<?php echo empty($user['portrait']) ? '/images/account-default.png' : $user['portrait']?>'/>
			<div class="messageWrapper">
				<h3 class="community"><?php echo $user['nickName']?></h3>
				<p class="membership"><?php echo empty($user['title']) ? 'No title.' : $user['title']?></p>
			</div>
			<a href="/message/<?php echo $user['id']?>/chat.html" class="message">MESSAGE</a>
		</div>
	</div>
	<div class="partOption aboutMe">
		<h3>About Me</h3>
		<div class="underLine"></div>
		<p class="desc">
			<?php echo empty($user['description']) ? 'User description.' : $user['description']?>
		</p>
		<div class="skill ulist">
			<h4>My Skills</h4>
			<?php if($user['skills']): ?>
			<ul>
			<?php foreach(explode(',',$user['skills']) as $list):?>
				<li><span><?php echo $list?></span></li>
			<?php endforeach;?>
			</ul>
			<?php else: ?>
			<p>no write</p>
			<?php endif; ?>
		</div>
		<div class="interest ulist">
			<h4>My Interests</h4>
			<?php if($user['interests']): ?>
			<ul>
			<?php foreach(explode(',',$user['interests']) as $list):?>
				<li><span><?php echo $list?></span></li>
			<?php endforeach;?>
			</ul>
			<?php else: ?>
			<p>no write</p>
			<?php endif; ?>
		</div>
	</div>
	<div class="partOption">
		<h3>Contact</h3>
		<div class="underLine"></div>
		<ul class="urlWrapper">
		    <li>
		    	<h4>Homepage</h4>
		    	<p><?php echo $user['website']?></p>
		    </li>
		    <div class="underLine"></div>
		     <li>
		    	<h4>Wechat</h4>
		    	<p><?php echo $user['wechatid']?></p>
		    </li>
		    <div class="underLine"></div>
		     <li>
		    	<h4>Facebook</h4>
		    	<p><?php echo $user['facebookid']?></p>
		    </li>
		    <div class="underLine"></div>
		    <li>
		    	<h4>Twitter</h4>
		    	<p><?php echo $user['twitterid']?></p>
		    </li>
		    <div class="underLine"></div>
		    <li>
		    	<h4>Linkedin</h4>
		    	<p><?php echo $user['linkedinid']?></p>
		    </li>
		    <div class="underLine"></div>
		    <li>
		    	<h4>Instagram</h4>
		    	<p><?php echo $user['instagramid']?></p>
		    </li>
		</ul>
	</div>
	<?php if($user['company']): ?>
	<div class="partOption">
		<h3>I Work At</h3>
		<div class="underLine"></div>
		<div class="companyWrapper">
		<?php if($user['companyid']['id']):?>
		<input type='hidden' class='companyid' value='<?php echo $user['companyid']['id']?>'>
			<img src="<?php echo $user['companyid']['logo']?:'/images/company-default.png' ?>" alt="">
			<h4><?php echo $user['companyid']['name']?></h4>
			<p><?php echo $companylocation?></p>
		<?php endif;?>
		</div>
	</div>
	<?php endif; ?>
	<div class="partOption postlist">
		<h3>Feed and Community</h3>
		<div class="underLine"></div>
		<!-- <div class="postWrapper">
			<div class="header">
				<img src="/images/portrait-default.png" alt="">
				<span class="time"></span>
				<h4>naked Retreats</h4>
				<p class="title"><?php echo empty($user['title'])?'No title':$user['title']?></p>
				<p class="companyName"><?php echo $user['companyid']['name']?></p>
				<p class="location">Location</p>
			</div>
			<p class="content">
				<?php echo $user['companyid']['introduction']?>
			</p>
		</div> -->
		<?php foreach($postlist as $value): ?>
		<div class="postWrapper" data-id="<?php echo $value['id'] ?>">
			<div class="header">
				<img class="user" src="<?php echo $value['portrait']?:'/images/account-default.png' ?>" alt="" data-id="<?php echo $value['userId'] ?>">
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
		</div>
		<?php endforeach; ?>
	</div>
</div>
<?php echo $this->renderPartial('_template') ?>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_profilejs', null ,true);
    $cs->registerScript('profile', $js, CClientScript::POS_END);
?>