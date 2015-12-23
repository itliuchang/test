<div id="account">
	<div class="option">
		<h3>OPEN DESK</h3>
		<div class="content">
			<div class="left">
				<h4>Entries:<?php echo $data['list'][0]['times'] ?> Days</h4>
				<p>Product:<?php echo $data['list'][0]['productname'] ?></p>
				<p>Duration:1 month</p>                             
				<p>Vaild until:<?php echo $data['list'][0]['endDate'] ?></p>
			</div>
			<div class="right">
					<h3><?php echo $data['user']['times'] ?></h3>
					<h3>DAYS</h3>
					<p>LEFT</p>
			</div>
		</div>
	</div>
	<?php array_shift($data['list'])?>
	<?php foreach($data['list'] as $item): ?>
	<div class="option nouse ">
		<h3>OPEN DESK</h3>
		<div class="content">
			<div class="left">
				<h4>Entries:<?php echo $item['times'] ?> Days</h4>
				<p>Product:<?php echo $item['productname'] ?></p>
				<p>Duration:1 month</p>                             
				<p>Vaild Date:<?php echo $item['startDate'] ?> - <?php echo $item['endDate'] ?></p>
			</div>
			<div class="right">
					<h3><?php echo $item['times'] ?></h3>
					<h3>DAYS</h3>
					<p>LEFT</p>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
	<a href="#" class="footer">ADD SUBSCRIPTION</a>
</div>