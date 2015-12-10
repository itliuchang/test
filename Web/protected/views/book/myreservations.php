<div id="myreservation">
	<div class="tabTitle">
		<div class="row wrapper">
			<div class="p col-xs-6">Previous Reservations</div>
			<div class="u col-xs-6 selected">Upcoming Reservations</div>
		</div>
	</div>
	<div class="upcoming">
		<div class="option">
			<p class="title"><span>星期二</span><span>12月1</span></p>
			<div class="content">
				<div class="left">
					<h3>STARTS IN</h3>
					<p class="start">12</p>
					<p class="date">2015年12月</p>
				</div>
				<div class="mid">
					<p>conference room:</p>
					<h3>Broccoli No.10 4FL</h3>
					<p>11:30-12:00 GMT-5</p>
				</div>
				<a class="right">cancel</a>
			</div>
		</div>
		<div class="option">
			<p class="title"><span>星期二</span><span>12月1</span></p>
			<div class="content">
				<div class="left">
					<h3>STARTS IN</h3>
					<p class="start">12</p>
					<p class="date">2015年12月</p>
				</div>
				<div class="mid">
					<p>conference room:</p>
					<h3>Broccoli No.10 4FL</h3>
					<p>11:30-12:00 GMT-5</p>
				</div>
				<a class="right">cancel</a>
			</div>
		</div>
		<div class="option">
			<p class="title"><span>星期二</span><span>12月1</span></p>
			<div class="content">
				<div class="left">
					<h3>STARTS IN</h3>
					<p class="start">12</p>
					<p class="date">2015年12月</p>
				</div>
				<div class="mid">
					<p>conference room:</p>
					<h3>Broccoli No.10 4FL</h3>
					<p>11:30-12:00 GMT-5</p>
				</div>
				<a class="right">cancel</a>
			</div>
		</div>
	</div>
	<div class="previous hide">
		<div class="option">
			<p class="title"><span>星期二</span><span>12月1</span></p>
			<div class="content">
				<div class="left">
					<h3>STARTS IN</h3>
					<p class="start">12</p>
					<p class="date">2015年12月</p>
				</div>
				<div class="mid">
					<p>conference room:</p>
					<h3>Broccoli No.10 4FL</h3>
					<p>11:30-12:00 GMT-5</p>
				</div>
			</div>
		</div>
		<div class="option">
			<p class="title"><span>星期二</span><span>12月1</span></p>
			<div class="content">
				<div class="left">
					<h3>STARTS IN</h3>
					<p class="start">12</p>
					<p class="date">2015年12月</p>
				</div>
				<div class="mid">
					<p>conference room:</p>
					<h3>Broccoli No.10 4FL</h3>
					<p>11:30-12:00 GMT-5</p>
				</div>
			</div>
		</div>
		<div class="option">
			<p class="title"><span>星期二</span><span>12月1</span></p>
			<div class="content">
				<div class="left">
					<h3>STARTS IN</h3>
					<p class="start">12</p>
					<p class="date">2015年12月</p>
				</div>
				<div class="mid">
					<p>conference room:</p>
					<h3>Broccoli No.10 4FL</h3>
					<p>11:30-12:00 GMT-5</p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_myreservationsjs', null ,true);
    $cs->registerScript('reservation', $js, CClientScript::POS_END);
?>