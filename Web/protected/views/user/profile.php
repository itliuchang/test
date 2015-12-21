<div id="profile">
	<div class="top">
		<div class="background">
			<img src="<?php echo empty($user['background']) ? '/images/background-default.png' : $user['background']?>"/>
			<div class="update"></div>
		</div>
		<div class="wrapperPortrait">
			<img class="portrait" src='<?php echo empty($user['portrait']) ? '/images/portrait-default.png' : $user['portrait']?>'/>
			<div class="messageWrapper">
				<h3 class="community"><?php echo $user['nickName']?></h3>
				<p class="membership"><?php echo empty($user['title']) ? 'No title.' : $user['title']?></p>
			</div>
			<a href="#" class="message">MESSAGE</a>
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
			<ul>
				<li><span>RESORT</span></li>
				<li><span>HOTEL</span></li>
				<li><span>ARCHITECTURE</span></li>
			</ul>
		</div>
		<div class="interest ulist">
			<h4>My Interests</h4>
			<ul>
				<li><span>RESORT</span></li>
				<li><span>HOTEL</span></li>
				<li><span>ARCHITECTURE</span></li>
			</ul>
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
		    	<p><?php echo $user['website']?></p>
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
	<div class="partOption">
		<h3>I Work At</h3>
		<div class="underLine"></div>
		<div class="companyWrapper">
			<img src="/images/company-default.png" alt="">
			<h4>naked Retreats</h4>
			<p>Cheisea</p>
		</div>
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