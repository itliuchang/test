<div id="private">
	<h2>BASIC INFO</h2>
	<div class="inputOption">
		<input type="text" placeholder="Full Name" class="name" required='required'>
		<input type="text" placeholder="Phone" class="phone" required='required'>
		<input type="email" placeholder="Email" class="email" required='required'>
		<input type="email" placeholder="Retype email" class="remail" required='required'>
	</div>
	
	<div class="inputOption">
		<label class='smalltitle'>I AM A...</label>
		<input type="number" placeholder="Number of people" class="number" required='required'>
		<select class='membertype' required='required'>
			<option value=''>Please choose</option>
			<?php foreach($type as $list):?>
			<option value='<?php echo $list['id']?>'><?php echo $list['name']?></option>
			<?php endforeach;?>
		</select>
		<select class='hub' required='required'>
			<option value=''>Please choose</option>
			<?php foreach($data as $list):?>
				<option value='<?php echo $list['id']?>'><?php echo $list['location']?></option>
			<?php endforeach;?>
		</select>
	</div>
	<span class='ps'>We will contact you asap to confirm availabity of sufficlent wordspaces for your team in this location.</span>
	<div class="footer">
		<div class="next">SUBMIT</div>
	</div>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_privatejs', null ,true);
    $cs->registerScript('regist', $js, CClientScript::POS_END);
?>