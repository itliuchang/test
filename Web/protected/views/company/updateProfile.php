<div id="companyUpdateProfile">
	<div class="top">
		<div class="background">
			<div class="addBackground"></div>
		</div>
		<div class="wrapperPortrait">
			<img class="portrait">
		</div>
	</div>
	<div class="inputSection">
		<input type="text" placeholder="company name" class="name">
		<input type="text" placeholder="company title" class="title">
		<input type="text" placeholder="website" class="website lastinput">
	</div>
	<div class="inputSection">
		<textarea placeholder="What we do" maxlength=140 rows=4 ></textarea>
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
		<input type="email" placeholder="Facebook url" class="facebook"> 
		<input type="email" placeholder="LinkIn url" class="linkIn">
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
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_updateProfilejs', null ,true);
    $cs->registerScript('company', $js, CClientScript::POS_END);
?>