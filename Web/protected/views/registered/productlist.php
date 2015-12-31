<div id="productlist">
	<h2 class="title">
		CHOOSE MEMBERSHIP TYPE
	</h2>
	<div class="item selected">
		<input type="text" value="1" class="productType" hidden>
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
		<input type="text" value="2" class="productType" hidden>
		<div class="choosenum">
			<div class="wrapper"><span class="minus">—</span><span class="value">1</span><span class="add">+</span></div>
			<p>months</p>
		</div>
		<div class="circleWrapper">
			<div></div>
		</div>
		<div class="content">
			<span class="type">STARTER PLUS</span>
			<p class="priceWrapper"><span class="icon">&yen;</span><span class="price">1000</span>/month</p>
			<p><span class="key">Workspace：</span>5 days/mo included</p>
			<p><span class="key">Conference：</span>unlimited</p>
		</div>
	</div>
	<div class="item">
		<input type="text" value="3" class="productType" hidden>
		<div class="choosenum">
			<div class="wrapper"><span class="minus">—</span><span class="value">1</span><span class="add">+</span></div>
			<p>months</p>
		</div>
		<div class="circleWrapper">
			<div></div>
		</div>
		<div class="content">
			<span class="type">UNLIMITED</span>
			<p class="priceWrapper"><span class="icon">&yen;</span><span class="price">2100</span>/month</p>
			<p><span class="key">Workspace：</span>unlimited</p>
			<p><span class="key">Conference：</span>unlimited</p>         
		</div>
	</div>
	<a class="footer">NEXT</a>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('__productlistjs', null ,true);
    $cs->registerScript('registered', $js, CClientScript::POS_END);
?>