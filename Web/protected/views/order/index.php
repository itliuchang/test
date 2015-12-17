<div id="orderDetail">
	<h2 class="title">MEMBERSHIP SUMMARY</h2>
	<div class="content">
		<?php for($i=0,$date=date("U");$i<$num;$i++): ?>
		<div class="month">
			<p class="memberType">Membership</p>
			<h2><?php echo $name ?></h2>
			<p class="date"><?php echo date("Y/m/d",$date) ?>-<?php echo date("Y/m/d",$date+2505600);$date = $date + 2592000;  ?></p>
			<div class="price"><h3>&yen;<?php echo $price ?></h3>/month</div>
		</div>
		<?php endfor; ?>
		<div class="day">
			<h2>Total</h2>
			<h3 class="price">&yen;<?php echo $num*$price ?></h3>
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