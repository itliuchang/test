<div id='edit-order-page' class='row-fluid'>
	<div class='row-fluid'>
		<div class='span12 box bordered-box blue-border'>
			<div class='box-content box-padding'>
				<fieldset>
					<div class='span12'>
						<div class='control-group'>
							<label class='control-label'>订单编号： <small class='muted'><?php echo $data['id']?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>产品： <small class='muted'><?php echo $data['product']['name']?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>购买人： <small class='muted'><?php echo $data['user']['nickName']?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>价格： <small class='muted'><?php echo $data['price']?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>下单时间： <small class='muted'><?php echo $data['orderTime']?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>支付时间： <small class='muted'><?php echo $data['payTime']?></small></label>
						</div>
						<div class='control-group'>
							<label class='control-label'>创建时间： <small class='muted'><?php echo $data['createTime']?></small></label>
						</div>	
					</div>
				</fieldset>
			</div>
		</div>
	</div>
</div>