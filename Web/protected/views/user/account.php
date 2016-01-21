<div id="account">
	<div class="tabTitle">
		<div class="row wrapper">
			<div class="p col-xs-6">Order History</div>
			<div class="u col-xs-6 selected">My Product</div>
		</div>
	</div>
	<div class="product">
		<?php foreach($productlist['list'] as $item): ?>
		<?php if($item['productType']==3): ?>
			<div class="option nouse ">
				<h3>HOTS DESK</h3>
				<div class="content">
					<div class="left">
						<h4>Entries:Unlimited</h4>
						<p>Member Type:Freelancer</p>
						<p>Duration:1 month</p>                             
						<p>Vaild Date:<?php echo $item['startDate'] ?> - <?php echo $item['endDate'] ?></p>
					</div>
					<div class="right">
						<h3 class="unlimited"></h3>
						<p>unlimited</p>
					</div>
				</div>
			</div>
		<?php elseif($item['productType']==1): ?>
		<div class="option nouse ">
			<h3>HOTS DESK</h3>
			<div class="content">
				<div class="left">
					<h4>Entries:<?php echo $item['totalTimes'] ?> Days</h4>
					<p>Member Type:Freelancer</p>
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
		<?php else: ?>
			<div class="option nouse ">
				<h3>Fixed</h3>
				<div class="content">
					<div class="left">
						<h4>Entries:<?php echo $item['productName'] ?></h4>
						<p>Member Type:Company</p>
						<p>Location:<?php echo $item['location'] ?></p>                             
						<p><?php echo $item['startDate'] ?> - <?php echo $item['endDate'] ?></p>
					</div>
					<div class="right">
						<h3 class="unlimited"></h3>
						<p>unlimited</p>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<?php endforeach; ?>
		<!-- <a href="/registered/productlist" class="footer">ADD SUBSCRIPTION</a> -->
	</div>
	<div class="order hide">
		<?php foreach($orderlist['list'] as $option): ?>
		<?php if(isset($option['productPrice'])): ?>
		<div class="option nouse ">
			<h3>VERFY<small><?php echo date('m-d',strtotime($option['createTime'])) ?></small></h3>
			<div class="content">
				<div class="left">
					<h4><?php echo $option['name'] ?> x <?php echo $option['orderPrice']/$option['productPrice'] ?></h4>
					<p>Entries:<?php echo $option['times'] ?></p>
				</div>
				<div class="right">
					<h2>&yen;<?php echo $option['orderPrice'] ?></h2>
				</div>
			</div>
		</div>
		<?php else: ?>
		<div class="option nouse ">
			<h3>FIXED<small><?php echo date('m-d',strtotime($option['createTime'])) ?></small></h3>
			<div class="content">
				<div class="left">
					<div class="date"><?php echo $option['product'][0]['startDate'] ?> - <?php echo $option['product'][0]['endDate'] ?></div>
					<h4>Location:<?php echo $option['name'] ?></h4>
					<?php foreach($option['product'] as $item): ?>
					<p><?php echo $item['productName'] ?> x<?php echo $item['num'] ?></p>
					<?php endforeach; ?>
					<div class="code">Activation code</div>
					<ul>
						<?php foreach($option['code'] as $item): ?>
						<li><span class="value"><?php echo $item['code'] ?></span><span class="times"><?php echo $item['usedTimes'] ?>/<?php echo $item['totalTimes'] ?></span></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="right">
					<h2>&yen;600</h2>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_accountjs', null ,true);
    $cs->registerScript('changepassword', $js, CClientScript::POS_END);
?>