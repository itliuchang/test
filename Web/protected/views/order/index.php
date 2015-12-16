<div id="orderDetail">
	<h2 class="title">MEMBERSHIP SUMMARY</h2>
	<div class="content">
		<div class="month">
			<p class="memberType">Membership</p>
			<h2>Starter</h2>
			<p class="date">2015/11/1-2015/11/30</p>
			<div class="price"><h3>&yen;300</h3>/month</div>
		</div>
		<div class="month">
			<p class="memberType">Membership</p>
			<h2>Starter</h2>
			<p class="date">2015/11/1-2015/11/30</p>
			<div class="price"><h3>&yen;300</h3>/month</div>
		</div>
		<div class="month">
			<p class="memberType">Membership</p>
			<h2>Starter</h2>
			<p class="date">2015/11/1-2015/11/30</p>
			<div class="price"><h3>&yen;300</h3>/month</div>
		</div>
		<div class="month">
			<p class="memberType">Membership</p>
			<h2>Starter</h2>
			<p class="date">2015/11/1-2015/11/30</p>
			<div class="price"><h3>&yen;300</h3>/month</div>
		</div>
		<div class="day">
			<h2>Total</h2>
			<h3 class="price">&yen;600</h3>
		</div>
	</div>
	<div class="agree"><div class="icon hasAgree"></div><p>I have read and understood the <a href="#">Terms & Conditions</a> of naked Hub and hereby agree to fully abide by them</p></div>
	<a class="footer" href="/post/newlist">Wechat Pay</a>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_js', null ,true);
    $cs->registerScript('order', $js, CClientScript::POS_END);
?>