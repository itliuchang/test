<div id="basicInfo">
	<h2>BASIC INFO</h2>
	<div class="inputOption">
		<input type="text" placeholder="Full Name" class="name">
		<input type="text" placeholder="Mobile Phone" class="phone">
		<input type="text" class="codenum" >
		<a href="#" class="codebutton act">CODE</a>
	</div>
		<!-- <div class="inputOption">
		<label class="bigTitle">I AM A...</label>
		<select>
			<option>Member Type</option>
			<option></option>
		</select>
	</div> -->
	<div class="inputOption">
		<label class="bigTitle">LOG IN INFORMATION</label>
		<label class="smallTitle">Email</label>
		<input type="email" placeholder="Email" class="email">
		<input type="password" placeholder="Create a password" class="password">
		<input type="password" placeholder="Repeat password" class="password">
	</div>
	<div class="footer">
		<a href="/registered/productlist" class="back">BACK</a>
		<a href="#" class="next">NEXT</a>
	</div>
</div>
<script>
	type = <?php echo $type ?>;
	name = '<?php echo $name ?>';
	num = <?php echo $num ?>;
	price = <?php echo $price ?>;
</script>

<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_registjs', null ,true);
    $cs->registerScript('regist', $js, CClientScript::POS_END);
?>