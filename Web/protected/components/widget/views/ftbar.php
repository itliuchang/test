<div class="row">
    <a class="col-xs-3 <?php echo $this->currentTab == '/post/newlist'? ' now' : '' ?>">
        <i class="home"></i><h3>Home</h3>
    </a>
    <a class="col-xs-3 <?php echo $this->currentTab == '/community/serviceslist'? ' now' : '' ?>">
        <i class="community"></i><h3>Community</h3>
    </a>
    <a class="fbar-message col-xs-3 <?php echo $this->currentTab == '/message/'? ' now' : '' ?>">
        <i class="message"></i><h3>Message</h3>
    </a>
    <a class="col-xs-3 <?php echo $this->currentTab == '/more/'? ' now' : '' ?>">
        <i class="more"></i><h3>More</h3>
    </a>
</div>