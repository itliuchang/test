<div id='faq'>
	<div class='banner'>
		<h2>naked HUB</h2>
		<span class='menubar'>MENU</span>
	</div>
	<div class='menu'>
		<ul>
			<a href='/about/faq'><li>FAQ</li></a>
			<a href='/about/locations'><li class='select'>Locations</li></a>
			<a href='/about/membertype'><li>Membership Types</li></a>
			<a href='/about/terms'><li>Terms & Conditions</li></a>
			<a href='/about/community'><li>Community Guidelines</li></a>
		</ul>
	</div>
	<div id="chooseEnvironment">
		<div>
			<img src="/images/banner/1.jpg">
	    	<h2><?php echo Yii::t('registered','FuXing    ') ?></h2>
	    	<div class="underLine"></div>
	    	<img src="/images/banner/2.jpg">
	    	<h2><?php echo Yii::t('registered','Hunan Road    ') ?></h2>
	    	<div class="underLine"></div>
	    	<img src="/images/banner/3.jpg">
	    	<h2><?php echo Yii::t('registered','West Nanjing Road   ') ?></h2>
	    	<div class="underLine"></div>
	    	<img src="/images/banner/4.jpg">
	    	<h2><?php echo Yii::t('registered','Lu Jia Zui    ') ?></h2>
	    	<div class="underLine"></div>
	    	<img src="/images/banner/5.jpg">
	    	<h2><?php echo Yii::t('registered','Hong Qiao   ') ?></h2>
	    	<div class="underLine"></div>
		</div>
	</div>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_faqjs', null ,true);
    $cs->registerScript('room', $js, CClientScript::POS_END);
?>