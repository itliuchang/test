<div id="account">
	<div class="tabTitle">
		<div class="row wrapper">
			<div class="p col-xs-6">Order History</div>
			<div class="u col-xs-6 selected">My Product</div>
		</div>
	</div>
	<div class="product">
		<?php foreach($data['list'] as $item): ?>
		<?php if($item['productType']==3): ?>
			<div class="option nouse ">
				<h3>OPEN DESK</h3>
				<div class="content">
					<div class="left">
						<h4>Entries:Unlimited</h4>
						<p>Product:<?php echo $item['productName'] ?></p>
						<p>Duration:1 month</p>                             
						<p>Vaild Date:<?php echo $item['startDate'] ?> - <?php echo $item['endDate'] ?></p>
					</div>
					<div class="right">
						<h3 class="unlimited"></h3>
						<p>unlimited</p>
					</div>
				</div>
			</div>
		<?php else: ?>
		<div class="option nouse ">
			<h3>OPEN DESK</h3>
			<div class="content">
				<div class="left">
					<h4>Entries:<?php echo $item['totalTimes'] ?> Days</h4>
					<p>Product:<?php echo $item['productName'] ?></p>
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
		<?php endif; ?>
		<?php endforeach; ?>
		<a href="/registered/productlist" class="footer">ADD SUBSCRIPTION</a>
	</div>
	<div class="order hide">
		
	</div>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_accountjs', null ,true);
    $cs->registerScript('changepassword', $js, CClientScript::POS_END);
?>