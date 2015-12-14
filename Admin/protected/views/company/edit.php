<input id='action-type'  type='hidden' value='<?php echo $this->action->id ?>'/>
<form id='edit_base_form' action='/company/editinfo' method='post' class='form' style='margin-bottom: 0;' enctype="multipart/form-data">
<div class='row-fluid'>
	<div class='span3 box'>
		<div class='box-content'>
			<?php if($data['logo']):?>
				<img id='logo_img' style='width:230px;height:230px;' src='<?php echo $data['logo'] ?>' />
			<?php else:?>
				<img id='logo_img' style='width:230px;height:230px;' src='http://naked.oss-cn-shanghai.aliyuncs.com/logo.png'>
			<?php endif;?>
		</div>
		<div style='margin-top: 15px;' id="logo_container">
			<span id='osslogo'></span>
			<a id="selectlogo" href="javascript:void(0);" class='upbtn'>选择头像</a>
			<a id="postlogo" href="javascript:void(0);" class='upbtn'>开始上传</a>
			<small class='muted'>建议分辨率280x480</small>
		</div>
		
		<hr class='hr-normal' />
		<div class='box-content'>
			<?php if($data['background']):?>
				<img id='background_img' style='width:230px;height:150px;' src='<?php echo $data['background'] ?>' />
			<?php else:?>
				<img id='background_img' style='width:230px;height:150px;' src='http://naked.oss-cn-shanghai.aliyuncs.com/background.png'>
			<?php endif;?>
		</div>
		<div style='margin-top: 15px;' id="background_container">
			<span id='ossbackground'></span>
			<a id="selectbackground" href="javascript:void(0);" class='upbtn'>选择背景</a>
			<a id="postbackground" href="javascript:void(0);" class='upbtn'>开始上传</a><small class='muted'>建议分辨率1280x480</small>
		</div>
	</div>
	<div class='span9 box bordered-box blue-border'>
		<div class='box-content box-double-padding'>
			<input type='hidden' id='logo' name='logo' value='<?php echo $data['logo'] ?>'/>
			<input type='hidden' id='background' name='background' value='<?php echo $data['background'] ?>'/>
			<input type='hidden' name='id' value='<?php echo $data['id'] ?>'/>
			
			<fieldset>
				<div class='span11'>
					<div class='control-group'>
						<div class='lead'>
							<i class='icon-signin text-contrast'></i> 公司信息 <small class='muted'></small>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>公司名称</label>
						<div class='controls'>
							<input class='span12' name='name' value='<?php echo $data['name']?>' type='text'/>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>联系方式</label>
						<div class='controls'>
							<input class='span12' name='phone' value='<?php echo $data['phone']?>' type='text'/>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>电子邮箱</label>
						<div class='controls'>
							<input class='span12' name='email' value='<?php echo $data['email']?>' type='text'/>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>地址 </label>
						<div class='controls'>
							<input class='span12' name='location' value='<?php echo $data['location']?>' type='text'/>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>所属中心 </label>
						<div class='controls'>
							<select name="hub">
							<?php foreach($hub as $list):?>
								<option value="<?php echo $list['id']?>" <?php echo $list['id']==$data['hubId']?'selected=selected':'' ?>><?php echo $list['name']?></option>
							<?php endforeach;?>
							</select>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>服务 </label>
						<div class='controls'>
							<select name="service">
							<?php foreach($service as $list):?>
								<option value="<?php echo $list['id']?>" <?php echo $list['id']==$data['serviceid']?'selected=selected':'' ?>><?php echo $list['name']?></option>
							<?php endforeach;?>
							</select>
						</div>
					</div>
					<hr class='hr-normal' />
					<div class='control-group'>
						<div class='lead'>
							<i class='icon-user text-contrast'></i> 详细资料
							<small class='muted'></small>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>网站 </label>
						<div class='controls'>
							<input class='span12' name='website' value='<?php echo $data['website']?>' type='text'/>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>Facebook </label>
						<div class='controls'>
							<input class='span12' name='facebook' value='<?php echo $data['facebookid']?>' type='text'/>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>LinkedIn </label>
						<div class='controls'>
							<input class='span12' name='linkedin' value='<?php echo $data['linkedinid']?>' type='text'/>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>描述</label>
						<div class='controls'>
							<input type='hidden' id='introduction' name='introduction' value="<?php echo CHtml::encode($data['introduction']) ?>"/>
							<div class='row-fluid'>
								<script id="ueditor_container" name="content" type="text/plain"></script>
							</div>
						</div>
					</div>
				</div>
			</fieldset>
			
			<div style='margin-bottom: 0;'>
				<div class='text-left'>
					<button id='btn-save' class='btn btn-primary' type='submit'> 保存 </button>
				</div>
			</div>
			
		</div>
	</div>
</div>
</form>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_js', null ,true);
    $cs->registerScript('login', $js, CClientScript::POS_END);
?>