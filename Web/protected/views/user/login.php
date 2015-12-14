<div id="login">
	<div class="tabTitle">
		<div class="row wrapper">
			<div class="phone col-xs-6 now">phone</div>
			<div class="Email col-xs-6">Email</div>
		</div>
	</div>
	<div class="inputOption clearfix phoneContent">
		<input type="text" value="" placeholder="Enter phone">
		<input type="text" class="codenum" placeholder="Enter code">
		<div class="codebutton">CODE</div>
	</div>
	<div class="inputOption hide EmailContent">
		<input type="email" value="" placeholder="Enter Email" class="email">
		<input type="text" placeholder="Enter a password" class="password">
	</div>
	<div class="agree"><div class="icon hasAgree"></div><p>I agree</p></div>
	<a class="footer" href="/post/newlist">LOG IN</a>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_loginjs', null ,true);
    $cs->registerScript('login', $js, CClientScript::POS_END);
?>