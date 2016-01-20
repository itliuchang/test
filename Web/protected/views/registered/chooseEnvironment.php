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
        <a class="a_code">[ I have an activation code ]</a>
        <div class="code hide">
            <input type="text" value="" placeholder="Enter CDK">
            <a class="btn_verify">verify</a>
        </div>
	</div>
	<div class="footer">
		<a href="/registered/productlist" class="open">Random</a>
		<a href="/registered/companyproductlist" class="private">Fixed</a>
	</div>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_chooseEnvironmentjs', null ,true);
    $cs->registerScript('regist', $js, CClientScript::POS_END);
?>