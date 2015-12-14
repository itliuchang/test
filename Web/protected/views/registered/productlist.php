<div id="productlist">
	<h2 class="title">
		CHOOSE MEMBERSHIP TYPE
	</h2>
	<div class="item selected">
		<div class="choosenum">
			<div class="wrapper"><span class="minus">—</span><span class="value">1</span><span class="add">+</span></div>
			<p>months</p>
		</div>
		<div class="circleWrapper">
			<div></div>
		</div>
		<div class="content">
			<span class="type">STARTER</span>
			<p class="priceWrapper"><span class="icon">&yen;</span><span class="price">300</span>/month</p>
			<p><span class="key">Workspace：</span>1 days/mo included</p>
			<p><span class="key">Conference：</span>unlimited</p>
		</div>
	</div>
	<div class="item">
		<div class="choosenum">
			<div class="wrapper"><span class="minus">—</span><span class="value">1</span><span class="add">+</span></div>
			<p>months</p>
		</div>
		<div class="circleWrapper">
			<div></div>
		</div>
		<div class="content">
			<span class="type">STARTER</span>
			<p class="priceWrapper"><span class="icon">&yen;</span><span class="price">300</span>/month</p>
			<p><span class="key">Workspace：</span>1 days/mo included</p>
			<p><span class="key">Conference：</span>unlimited</p>
		</div>
	</div>
	<div class="item">
		<div class="choosenum">
			<div class="wrapper"><span class="minus">—</span><span class="value">1</span><span class="add">+</span></div>
			<p>months</p>
		</div>
		<div class="circleWrapper">
			<div></div>
		</div>
		<div class="content">
			<span class="type">STARTER</span>
			<p class="priceWrapper"><span class="icon">&yen;</span><span class="price">300</span>/month</p>
			<p><span class="key">Workspace：</span>1 days/mo included</p>
			<p><span class="key">Conference：</span>unlimited</p>
		</div>
	</div>
	<a class="footer" href="/registered/basicInfo">NEXT</a>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('__productlistjs', null ,true);
    $cs->registerScript('registered', $js, CClientScript::POS_END);
?>