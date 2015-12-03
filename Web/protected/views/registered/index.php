<div id="access">
	<div class="bannerWrapper">
		<div class="banner">
			<ul>
			    <li>
			    	<div class="pic pic1"></div>
			    	<h2>THE COMMUNITY</h2>
			    	<div class="underLine"></div>
			    	<p>Wework members are incredibly diverse,ranging from the startup,freelancer,and artist to the small business and large multinational.Got a question ?Ask the community.</p>
			    </li>
			    <li>
			    	<div class="pic pic2"></div>
			    	<h2>THE COMMUNITY</h2>
			    	<div class="underLine"></div>
			    	<p>Wework members are incredibly diverse,ranging from the startup,freelancer,and artist to the small business and large multinational.Got a question ?Ask the community.</p>
			    </li>
			    <li>
			    	<div class="pic pic3"></div>
			    	<h2>THE COMMUNITY</h2>
			    	<div class="underLine"></div>
			    	<p>Wework members are incredibly diverse,ranging from the startup,freelancer,and artist to the small business and large multinational.Got a question ?Ask the community.</p>
			    </li>
			    <li>
			    	<div class="pic pic4"></div>
			    	<h2>THE COMMUNITY</h2>
			    	<div class="underLine"></div>
			    	<p>Wework members are incredibly diverse,ranging from the startup,freelancer,and artist to the small business and large multinational.Got a question ?Ask the community.</p>
			    </li>
			</ul>
		</div>
	</div>
	<div class="footer">
		<a href="#" class="registered">BECOME A NAKEDHUB MEMBER</a>
		<a href="#" class="login">I'M ALREADY A NAKEHUB MEMBER</a>
	</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_js', null ,true);
    $cs->registerScript('registered', $js, CClientScript::POS_END);
?>
</div>
