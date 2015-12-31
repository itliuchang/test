<div id="access">
	<div class="bannerWrapper">
		<div class="banner">
			<ul>
			    <li>
			    	<div class="pic pic1"></div>
			    	<h2><?php echo Yii::t('registered','COMMUNITY') ?></h2>
			    	<div class="underLine"></div>
			    	<p><?php echo Yii::t('registered','naked Hub is a tribe of individuals who crave fulfilling work as part of a healthy life.') ?></p>
			    </li>
			    <li>
			    	<div class="pic pic2"></div>
			    	<h2><?php echo Yii::t('registered','SPACES') ?></h2>
			    	<div class="underLine"></div>
			    	<p><?php echo Yii::t('registered','Work in a naked space: beautiful design that brings nature indoors.Get all the facilities you need, with the extras that make coming to work fun.') ?></p>
			    </li>
			    <li>
			    	<div class="pic pic3"></div>
			    	<h2><?php echo Yii::t('registered','PERKS') ?></h2>
			    	<div class="underLine"></div>
			    	<p><?php echo Yii::t('registered','Beyond the community and space,we sprinkle in some extra treats that make working naked fun.') ?></p>
			    </li>
			    <li>
			    	<div class="pic pic4"></div>
			    	<h2><?php echo Yii::t('registered','FUN') ?></h2>
			    	<div class="underLine"></div>
			    	<p><?php echo Yii::t('registered','naked Hub is a fresh take on work and play.Home to a diverse community of creatives, entrepreneurs and dreamers, these co-working hubs are a place to come together to learn, meet and collaborate with your peers.') ?></p>
			    </li>
			</ul>
		</div>
	</div>
	<div class="footer">
		<a href="/registered/chooseEnvironment" class="registered"><?php echo Yii::t('registered','JOIN THE COMMUNITY') ?></a>
		<a href="/login" class="login"><?php echo Yii::t('registered',"LOGIN") ?></a>
	</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_js', null ,true);
    $cs->registerScript('registered', $js, CClientScript::POS_END);
?>
</div>
