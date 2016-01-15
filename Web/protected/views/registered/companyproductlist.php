<div id="productlist">
	<h2 class="title">
		CHOOSE MEMBERSHIP
	</h2>
	<div class="datewrapper">
		<div class="left">
			<input type="date" class="date">
		</div>
		<div class="right">
			<select>
				<option selected>choose months</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
				<option>6</option>
			</select>
		</div>
	</div>
	<h2 class="title2">NEAREST AVAILABLE</h2>
	<div class="item selected">
		<input type="text" value="1" class="productType" hidden>
		<div class="choosenum">
			<div class="wrapper"><span class="minus">—</span><span class="value">1</span><span class="add">+</span></div>
			<p class="numleft">16 left</p>
		</div>
		<div class="circleWrapper">
			<div></div>
		</div>
		<div class="content">
			<span class="type">Open desk</span>
			<p class="priceWrapper"><span class="icon">&yen;</span><span class="price">300</span>/month</p>
		</div>
	</div>
	<div class="item">
		<input type="text" value="2" class="productType" hidden>
		<div class="choosenum">
			<div class="wrapper"><span class="minus">—</span><span class="value">1</span><span class="add">+</span></div>
			<p class="numleft">16 left</p>
		</div>
		<div class="circleWrapper">
			<div></div>
		</div>
		<div class="content">
			<span class="type">1 Private</span>
			<p class="priceWrapper"><span class="icon">&yen;</span><span class="price">1000</span>/month</p>
		</div>
	</div>
	<div class="item">
		<input type="text" value="3" class="productType" hidden>
		<div class="choosenum">
			<div class="wrapper"><span class="minus">—</span><span class="value">1</span><span class="add">+</span></div>
			<p class="numleft">16 left</p>
		</div>
		<div class="circleWrapper">
			<div></div>
		</div>
		<div class="content">
			<span class="type">2 Private</span>
			<p class="priceWrapper"><span class="icon">&yen;</span><span class="price">2100</span>/month</p>
		</div>
	</div>
	<a class="footer">NEXT</a>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_companyproductlistjs', null ,true);
    $cs->registerScript('registered', $js, CClientScript::POS_END);
?>