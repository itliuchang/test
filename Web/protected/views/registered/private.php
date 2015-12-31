<div id="private">
	<h2>BASIC INFO</h2>
	<div class="inputOption">
		<input type="text" placeholder="Full Name" class="name">
		<input type="text" placeholder="Phone" class="phone">
		<input type="text" placeholder="Email" class="email" >
		<input type="text" placeholder="Retype email" class="remail" >
	</div>
	
	<div class="inputOption">
		<label class='smalltitle'>I AM A...</label>
		<input type="number" placeholder="Number of people" class="remail" >
		<select class='membertype'>
			<option value=''>请选择</option>
			<?php foreach($type as $list):?>
			<option value='<?php echo $list['id']?>'><?php echo $list['name']?></option>
			<?php endforeach;?>
		</select>
		<select class='hub'>
			<option value=''>请选择</option>
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
    $cs->registerScript('regist', $js, CClientScript::POS_END);
?>