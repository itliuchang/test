<div id="companyUpdateProfile">
	<div class="top">
		<div class="background" id='background_container' style="background:url(<?php echo $company['background']?>)">
			<div class="addBackground" id="selectbackground"></div>
		</div>
		<div class="wrapperPortrait" id='logo_container'>
			<img class="portrait" id='selectlogo' src='<?php echo $company['logo']?>'>
		</div>
	</div>
	<div class="inputSection">
		<input type='hidden' name='id' value='<?php echo $company['id']?>'>
		<input type='hidden' class='status' value='<?php echo $status?>'>
		<input type='hidden' class='backgroundurl' value='<?php echo $company['background']?>'>
		<input type="text" placeholder="company name" class="name" value='<?php echo $company['name']?>'>
		<input type="email" placeholder="company email" class="email" value='<?php echo $company['email']?>'>
		<input type="text" placeholder="company phone" class="phone" value='<?php echo $company['phone']?>'>
		<input type="text" placeholder="website" class="website lastinput" value='<?php echo $company['website']?>'>
	</div>
	<div class="inputSection">
		<textarea placeholder="What we do" maxlength=140 rows=4 class='introduction'><?php echo $company['introduction']?></textarea>
	</div>
	<div class="inputSection">
		<h3 class="addService">Service offerings</h3>
		<div class="serviceWrapper">
			<ul class="clearfix">
				<li><span>Design</span><span class="x">X</span></li>
			    <li><span>design</span><span class="x">X</span></li>
			    <li><span>design</span><span class="x">X</span></li>
			    <li><span>design</span><span class="x">X</span></li>
			</ul>
		</div>
	</div>
	<div class="inputSection link">
		<input type="email" placeholder="Facebook" class="facebook" value='<?php echo $company['facebookid']?>'> 
		<input type="email" placeholder="LinkIn" class="linkIn" value='<?php echo $company['linkedinid']?>'>
	</div>
	<h2 class="footer">NEXT</h2>
	<div class="servicelist hide" id="wrapper">
		<div class="header">
			<h3>Services</h3>
			<div class="cancel">cancel</div>
			<div class="ok">ok</div>
		</div>
		<ul class="outer">
		    <li>
		    	<p>Photography</p>
		    	<ul class="inner hide">
		    	    <li>A</li>
		    	    <li>B</li>
		    	    <li>C</li>
		    	    <li>D</li>
		    	</ul>
		    </li>
		    <li>
		    	<p>Web</p>
		    </li>
		    <li>
		    	<p>Web Design</p>
		    </li>
		    <li>
		    	<p>Illustrations</p>
		    </li>
		    <li>
		    	<p>Photography</p>
		    	<ul class="inner hide">
		    	    <li>A</li>
		    	    <li>B</li>
		    	    <li>C</li>
		    	    <li>D</li>
		    	</ul>
		    </li>
		    <li>
		    	<p>Web</p>
		    </li>
		    <li>
		    	<p>Web Design</p>
		    </li>
		    <li>
		    	<p>Illustrations</p>
		    </li>
		    <li>
		    	<p>Photography</p>
		    	<ul class="inner hide">
		    	    <li>A</li>
		    	    <li>B</li>
		    	    <li>C</li>
		    	    <li>D</li>
		    	</ul>
		    </li>
		    <li>
		    	<p>Web</p>
		    </li>
		    <li>
		    	<p>Web Design</p>
		    </li>
		    <li>
		    	<p>Illustrations</p>
		    </li>
		</ul>
	</div>
</div>
<script type="text/javascript">

    var domain = '<?php echo Assist::getOSSToken()['domain'] ?>',
    	token = '<?php echo Assist::getOSSToken()['uptoken']?>';
    	token = eval('(' + token + ')')

    
</script>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_updateProfilejs', null ,true);
    $cs->registerScript('company', $js, CClientScript::POS_END);
?>