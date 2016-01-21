<div id='faq'>
	<div class='banner'>
		<h2>naked HUB</h2>
		<span class='menubar'>MENU</span>
	</div>
	<div class='menu hide'>
		<ul>
			<a href='/about/faq'><li class='select'>FAQ</li></a>
			<a href='/about/locations'><li>Locations</li></a>
			<a href='/about/membertype'><li>Membership Types</li></a>
			<a href='/about/terms'><li>Terms & Conditions</li></a>
			<a href='/about/community'><li>Community Guidelines</li></a>
		</ul>
	</div>
	<div class='main'>
		<h1>COMMONS FAQ</h1>
		<h2>Facility</h2>
		<ul class='fir'>
			<li>Open 24 hours.</li>
			<li>Wifi – user name and password to be obtained from front desk at time of check in. </li>
			<li>Air-conditioner will be turned off in all other areas from 8pm – 8am. </li>
			<li>4th floor glass door to be manually locked from 8pm – 8am on weekdays and all day on weekends (unless there is an event). All
after-hour entrance needs to go through 3rd floor front desk.</li>
			<li>All guests need to sign in at the front desk. </li>
			<li>Please turn off Lights and Air-conditioner everyday when you leave.</li>
		</ul>
		<h2>Meeting rooms</h2>
		<ul class='fir'>
			<li>All usage must be booked at front desk. </li>
			<li>2 hours of usage included per member per month (all sizes of meeting rooms). </li>
				<ul class='sec'>
					<li>Unused credits do not carry over to next month. </li>
				</ul>
			<li>For each additional hour :</li>
				<ul class='sec'>
					<li>Small meeting rooms (6 people and under) – 150 RMB/hour </li>
					<li>Big meeting rooms (7 people and over) – 200 RMB/hour</li>
				</ul>
		</ul>
		<h2>Printer</h2>
		<ul class='fir'>
			<li>Print instruction to be obtained from front desk at time of check in. </li>
			<li>Print pages included per member per month, unused credits do not carry over to next month. </li>
				<ul class='sec'>
					<li>A4 black & white（黑白） – 50 pages（页）</li>
					<li>A4 color （彩色） – 25 pages（页）</li>
					<li>A3 black & white （黑白） – 25 pages（页）</li>
					<li>A3 color （彩色） – 13 pages（页）</li>
				</ul>
			<li>Each additional page</li>
				<ul class='sec'>
					<li>A4 black & white （黑白） – 1 RMB/page（页）</li>
					<li>A4 color （彩色） – 2 RMB/page（页）</li>
					<li>A3 black & white （黑白） – 2 RMB/page（页）</li>
					<li>A3 color （彩色） – 4 RMB/page（页）</li>
				</ul>
		</ul>
		<h2>Events in living room</h2>
		<ul class='fir'>
			<li>4 hours of living room usage for event hosting per team per month. </li>
			<li>Each additional hour – 300 RMB/hour.</li>
			<li>If events are open to public – allow all naked Hub members to join for free or at a discount.</li>
			<li>If events are not open to public – naked Hub members will still be allowed in partial areas of the living room and in the bar area.</li>
			<li>Catering through our exclusive partner naked Bite only.</li>
		</ul>
	</div>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_faqjs', null ,true);
    $cs->registerScript('room', $js, CClientScript::POS_END);
?>