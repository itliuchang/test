<script id='productlistTpl' type="text/html">
	{{ each data as v k }}
		<div class="item">
			<input type="text" value="{{ v.id }}" class="productType" hidden>
			<div class="choosenum">
				<div class="wrapper"><span class="minus">—</span><span class="value">1</span><span class="add">+</span></div>
				<p class="numleft">{{ v.left }} left</p>
			</div>
			<div class="circleWrapper">
				<div></div>
			</div>
			<div class="content">
				<span class="type">{{ v.name }}</span>
				<p class="priceWrapper"><span class="icon">&yen;</span><span class="price">{{ v.price }}</span>/month</p>
			</div>
		</div>
	{{ /each }}
</script>