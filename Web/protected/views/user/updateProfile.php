<div id="updateProfile">
	<div class="top">
		<div class="background" id='background_container' style="background-image:url(<?php echo $user['background']?>)">
			<div class="addBackground" id='selectbackground'></div>
		</div>
		<div class="wrapperPortrait" id='portrait_container'>
			<img class="portrait" id='selectportrait' src='<?php echo $user['portrait']?>'>
		</div>
	</div>
	<div class="inputSection">
		<input type="text" placeholder="name" class="name" value='<?php echo $user['nickName']?>' >
		<input type="text" placeholder="title" class="title" value='<?php echo $user['title']?>' >
		<input type="text" placeholder="website" class="website lastinput" value='<?php echo $user['website']?>'>
		<input type='hidden' class='backgroundurl' value='<?php echo $user['background']?>'>
		<input type='hidden' class='status' value='<?php echo $user['status']?>'>
	</div>
	<div class="inputSection">
		<textarea placeholder="about me (140 characters)" maxlength=140 rows=4 class='description'><?php echo $user['description']?></textarea>
	</div>
	<div class="inputSection">
		<div class="birthdayWrapper">
			<label>birthday</label>
			<input type="date" class="birthday" value='<?php echo $user['birthday']?>'>
		</div>
		<label>gender</label>
		<select class="sex">
			<option value='0' <?php echo $user['gender']==0?'selected=selected':''?>>Please choose</option>
			<option value='1' <?php echo $user['gender']==1?'selected=selected':''?>>male</option>
			<option value='2' <?php echo $user['gender']==2?'selected=selected':''?>>female</option>
		</select>
		<div class="hub">
		<label>Location</label>
		<select class='location'>
		<?php foreach($hub as $list):?>
			<option value='<?php echo $list['id']?>' <?php echo $list['id']==$user['location']?'selected=selected':''?>><?php echo $list['location']?></option>
		<?php endforeach;?>
		</select>
		</div>
	</div>
	<div class="inputSection">
		<textarea placeholder="Enter your skills(PS:design,develop)" maxlength=140 rows=4 class='skills'><?php echo $user['skills']?></textarea>
	</div>
	<div class="inputSection">
		<textarea placeholder="Enter your interests(PS:pingpong,basketball)" maxlength=140 rows=4 class='interests'><?php echo $user['interests']?></textarea>
	</div>
	<div class="inputSection link">
		<input type="text" placeholder="WechatID" disabled class="wechatId" value='<?php echo $user['wechatid']?>'>
		<input type="email" placeholder="Facebook " class="facebook" value='<?php echo $user['facebookid']?>'> 
		<input type="text" placeholder="Twitter" class="twitter" value='<?php echo $user['twitterid']?>'>
		<input type="email" placeholder="LinkIn " class="linkIn" value='<?php echo $user['linkedinid']?>'>
		<input type="email" placeholder="Instagram " class="instagram lastinput" value='<?php echo $user['instagramid']?>'>
	</div>
	<?php if($user['status'] == 1):?>
		<h2 class="footer">NEXT</h2>
	<?php else:?>
		<h2 class="footer save">SAVE</h2>
	<?php endif;?>
</div>
<script type="text/javascript">
	var domain = '<?php echo Assist::getOSSToken()['domain'] ?>',
    	token = '<?php echo Assist::getOSSToken()['uptoken']?>';
    	token = eval('(' + token + ')')
</script>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_updateprofilejs', null ,true);
    $cs->registerScript('profile', $js, CClientScript::POS_END);
?>