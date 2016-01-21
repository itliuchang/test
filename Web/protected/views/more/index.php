<div id="more">
	<div class="row book">
		<a class="col-xs-6 room" href='/book/roomlist'>Book a Room</a>
		<a class="col-xs-6 workspace" href='/book/workspacelist'>Book Workspace</a>
	</div>
	<ul class="option">
		<li class="reservations"><a href="/book/myreservations">Upcoming Reservations</a></li>
		<li class="guide"><a href="/about/faq">Guide</a></li>
		<li class="myprofile" ><a href='/user/profile'>My Profile</a></li>
		<li class="companyProfile"><a href='/company/profile'>Company Profile</a></li>
		<li class="account"><a href="/user/account">Account</a></li>
		<li class="password"><a href='/user/changepassword'>Change password</a></li>
	</ul>
	<ul class="option">
		<li class="about"><a href='/about/aboutus'>About</a></li>
		<li class="logout"><a href='/logout'>Log out</a></li>
	</ul>
</div>
<div class="container-fluid tbar" id="footer">
    <?php $this->widget('FTBarWidget',array('currentTab' => '/more/')) ?>
</div>