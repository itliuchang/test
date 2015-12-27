<div id="account">
	<?php foreach($data['list'] as $item): ?>
	<div class="option nouse ">
		<h3>OPEN DESK</h3>
		<div class="content">
			<div class="left">
				<h4>Entries:<?php echo $item['totalTimes'] ?> Days</h4>
				<p>Product:<?php echo $item['productname'] ?></p>
				<p>Duration:1 month</p>                             
				<p>Vaild Date:<?php echo $item['startDate'] ?> - <?php echo $item['endDate'] ?></p>
			</div>
			<div class="right">
					<h3><?php echo $item['totalTimes']-$item['usedTimes'] ?></h3>
					<h3>DAYS</h3>
					<p>LEFT</p>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
	<a href="/registered/productlist" class="footer">ADD SUBSCRIPTION</a>
</div>