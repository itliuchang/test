<div id='faq'>
	<div class='banner'>
		<h2>naked HUB</h2>
		<span class='menubar'>MENU</span>
	</div>
	<div class='menu'>
		<ul>
			<a href='/about/faq'><li>FAQ</li></a>
			<a href='/about/locations'><li>Locations</li></a>
			<a href='/about/membertype'><li class='select'>Membership Types</li></a>
			<a href='/about/terms'><li>Terms & Conditions</li></a>
			<a href='/about/community'><li class='last'>Community Guidelines</li></a>
		</ul>
	</div>
	<div id="chooseEnvironment">
		<div>
			<div class="pic pic1"></div>
	    	<h2><?php echo Yii::t('registered','JOIN THE COMMUNITY    ') ?></h2>
	    	<div class="underLine"></div>
	    	<p><?php echo Yii::t('registered','Membership at naked Hub offers individuals the benefits of corporate work with 21st century freedom.') ?></p>
	    	<div class="table">
	    		<h3>SPACE</h3>
	    		<p>We offer 2 types of workspaces: open desks or designated Pods.</p>
	    		<p>All include 24/7 access to our online community of creators.</p>
	    		<p>Open desks are perfect for individuals, freelancers and small businesses.</p>
	    		<img src="/images/banner/6.png" alt="">
	    		<h4>open desk</h4>
	    		<img src="/images/banner/7.png" alt="">
	    		<h4>designated Pods</h4>
	    	</div>
		</div>
	</div>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_faqjs', null ,true);
    $cs->registerScript('room', $js, CClientScript::POS_END);
?>