<div id="login">
	<div class="tabTitle">
		<div class="row wrapper">
			<div class="phone col-xs-6 now">phone</div>
			<div class="Email col-xs-6">Email</div>
		</div>
	</div>
	<div class="inputOption clearfix phoneContent">
		<input type="tel" value="" placeholder="Enter phone">
		<input type="text" class="codenum" placeholder="Enter code">
		<div class="codebutton act">CODE</div>
	</div>
	<div class="inputOption hide EmailContent">
		<input type="email" value="" placeholder="Enter Email" class="email">
		<input type="password" placeholder="Enter a password" class="password">
	</div>
	<div class="agree"><div class="icon hasAgree"></div><p>Remember my login info and keep me signed in</p></div>
	<a class="footer">LOG IN</a>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_loginjs', null ,true);
    $cs->registerScript('login', $js, CClientScript::POS_END);
?>