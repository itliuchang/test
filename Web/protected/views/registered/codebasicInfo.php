<div id="basicInfo">
	<h2>BASIC INFO</h2>
	<div class="inputOption">
		<input type="text" placeholder="Full Name" class="name">
		<input type="text" placeholder="Mobile Phone" class="phone">
		<input type="text" class="codenum" >
		<a class="codebutton act">CODE</a>
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
		<input type="email" placeholder="Email" class="email">
		<input type="password" placeholder="Create a password" class="password">
		<input type="password" placeholder="Repeat password" class="password">
	</div>
	<div class="footer">
		<a href="/registered/productlist" class="back">BACK</a>
		<div class="next">NEXT</div>
	</div>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_codebasicInfojs', null ,true);
    $cs->registerScript('regist', $js, CClientScript::POS_END);
?>