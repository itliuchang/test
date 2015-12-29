<div id="companyProfile">
<input type='hidden' name='id' value='<?php echo $company['id']?>'>
	<div class="top">
		<div class="background" style="background-image:url(<?php echo $company['background']?>)">
			<?php if($company['ownerId']==Yii::app()->user->id): ?>
			<div class="update"></div>
			<?php endif; ?>
		</div>
		<div class="wrapperPortrait">
			<img class="portrait" src='<?php echo $company['logo']?>'>
			<div class="messageWrapper">
				<h3 class="companyName"><?php echo $company['name']?></h3>
				<p class="location"><?php echo $company['location']?></p>
			</div>
		</div>
	</div>
	<div class="partOption aboutMe">
		<h3>What we do</h3>
		<div class="underLine"></div>
		<p class="desc">
			<?php echo $company['introduction']?>
		</p>
		<div class="service ulist">
			<h4>Service offerings</h4>
			<?php if($service): ?>
			<ul>
			<?php foreach($service as $list):?>
				<li><span><?php echo $list['name']?></span></li>
			<?php endforeach;?>
			</ul>
			<?php else: ?>
			<p>no write</p>
			<?php endif;?>
		</div>
	</div>
	<div class="partOption">
		<h3>Contact</h3>
		<div class="underLine"></div>
		<ul class="urlWrapper">
		    <li>
		    	<h4>Homepage</h4>
		    	<p><?php echo $company['website']?></p>
		    </li>
		    <div class="underLine"></div>
		     <li>
		    	<h4>Facebook</h4>
		    	<p><?php echo $company['facebookid']?></p>
		    </li>
		    <div class="underLine"></div>
		    <li>
		    	<h4>Linkedin</h4>
		    	<p><?php echo $company['linkedinid']?></p>
		    </li>
		</ul>
	</div>
	<div class="partOption">
		<h3>Feed and Community</h3>
		<div class="underLine"></div>
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
		</div>
	</div>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_profilejs', null ,true);
    $cs->registerScript('profile', $js, CClientScript::POS_END);
?>