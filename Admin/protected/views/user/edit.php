<div class='row-fluid'>
	<div class='span3 box'>
		<div id='portrait_container' class='box-content'>
			<?php if($data['portrait']):?>
				<img id='portrait' style='width:230px;height:230px;' src='<?php echo $data['portrait'] ?>' />
			<?php else:?>
				<img id='portrait' style='width:230px;height:230px;' src='http://placehold.it/230x230&amp;text=上传头像'>
			<?php endif;?>
		</div>
		<div style='margin-top: 15px;'>
			<span id='pickfiles' class='btn btn-success'><i class='icon-picture'></i> 上传头像</span>&nbsp;&nbsp;<small class='muted'>建议分辨率200x200</small>
		</div>
		
		<hr class='hr-normal' />
		<div id='background' class='box-content'>
			<?php if($data['background']):?>
				<img id='background' style='width:230px;height:150px;' src='<?php echo $data['background'] ?>' />
			<?php else:?>
				<img id='background' style='width:230px;height:150px;' src='http://placehold.it/230x150&amp;text=上传背景'>
			<?php endif;?>
		</div>
		<div style='margin-top: 15px;'>
			<span id='background_pickfiles' class='btn btn-success'><i class='icon-picture'></i> 上传背景</span>&nbsp;&nbsp;<small class='muted'>建议分辨率1280x480</small>
		</div>
	</div>
	<div class='span9 box'>
		<div class='box-content box-double-padding'>
			<form id='form' class='form' style='margin-bottom: 0;'>
			<input type='hidden' name='id' value='<?php echo $data['id'] ?>'/>
			<input type='hidden' id='portrait' name='portrait' value='<?php echo $data['portrait'] ?>'/>
			<input type='hidden' id='background' name='background' value='<?php echo $data['background'] ?>'/>
			<input type='hidden' name='action' value='<?php echo $this->action->id ?>'/>
			<fieldset>
				<div class='span11'>
					<div class='control-group'>
						<div class='lead'>
							<i class='icon-signin text-contrast'></i> 达人信息 <small class='muted'>填写真实的资料，有助于大家记住你哟.</small>
						</div>
						
					</div>
					<div class='control-group'>
						<label class='control-label'>昵称 <span class='text-red'>*</span></label>
						<div class='controls'>
							<input class='span12' name='nickName' type='text' value='<?php echo $data['nickName'] ?>' data-rule-required='true'/>
						</div>
					</div>
					
					<div class='control-group'>
						<label class='control-label'>性别 </label>
						<div class='controls'>
							<select name='gender'>
								<option value='1' <?php if($data['gender']==1) echo 'selected=selected'?>>男</option>
								<option value='2' <?php if($data['gender']==2) echo 'selected=selected'?>>女</option>
							</select>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>生日</label>
						<div class='controls'>
							<input class='span12' name='mobile'type='text' value='<?php echo substr($data['birthday'],0,10) ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>手机号</label>
						<div class='controls'>
							<input class='span12' name='mobile' data-rule-phoneus='true' type='text' value='<?php echo $data['mobile'] ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>电子邮件</label>
						<div class='controls'>
							<input class='span12' name='email' data-rule-email='true' type='text' value='<?php echo isset($data['email'])?$data['email']:"" ?>' />
						</div>
					</div>
				</div>
			</fieldset>
			<hr class='hr-normal' />
			<fieldset>
				<div class='span11'>
					<div class='control-group'>
						<div class='lead'>
							<i class='icon-user text-contrast'></i> 详细资料
							<small class='muted'>填写真实的资料，有助于好友找到你哦.</small>
						</div>
					</div>					
					<div class='control-group'>
						<label class='control-label'>职业</label>
						<div class='controls'>
							<input class='span12' name='work' type='text' value='<?php echo $data['work'] ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>用户类型</label>
						<div class='controls'>
							<input class='span12' name='work' type='text' value='<?php echo $data['work'] ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>所属公司</label>
						<div class='controls'>
							<input class='span12' name='work' type='text' value='<?php echo $data['companyid']['name'] ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>公司职位</label>
						<div class='controls'>
							<input class='span12' name='work' type='text' value='<?php echo $data['role']==1?'老板':'员工' ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>头衔</label>
						<div class='controls'>
							<input class='span12' name='work' type='text' value='<?php echo $data['title'] ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>关注</label>
						<div class='controls'>
							<input class='span12' name='work' type='text' value='<?php echo $data['followers'] ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>工作楼层</label>
						<div class='controls'>
							<input class='span12' name='work' type='text' value='<?php echo $data['floor'] ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>个人网站</label>
						<div class='controls'>
							<input class='span12' name='work' type='text' value='<?php echo $data['website'] ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>Facebook</label>
						<div class='controls'>
							<input class='span12' name='facebook' type='text' value='<?php echo $data['facebookid'] ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>Twitter</label>
						<div class='controls'>
							<input class='span12' name='twitter' type='text' value='<?php echo $data['twitterid'] ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>LinkedIn</label>
						<div class='controls'>
							<input class='span12' name='linkedin' type='text' value='<?php echo $data['linkedinid'] ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>Instagram</label>
						<div class='controls'>
							<input class='span12' name='instagram' type='text' value='<?php echo $data['instagramid'] ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>描述</label>
						<div class='controls'>
							<input type='hidden' id='description' name='description' value="<?php echo CHtml::encode($data['description']) ?>"/>
							<div class='row-fluid'>
								<script id="ueditor_container" name="content" type="text/plain"></script>
							</div>
						</div>
					</div>
				</div>
			</fieldset>
			<div class='form-actions' style='margin-bottom: 0;'>
				<div class='text-right'>
					<button id='btn-save' class='btn btn-primary btn-large' type='submit'> <i class='icon-save'></i> 保存 </button>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>

<?php
    $cs = Yii::app()->clientScript;
    $js = <<<STR
        $(function(){
        	var ue = UE.getEditor('ueditor_container', {
			    autoHeight: true,
			});
			ue.ready(function(){
				ue.setContent($('#description').val());
				ue.on('showmessage', function(type, m){
				    if (m['content'] == '本地保存成功') {
				        return true;
				    }
				});
			});
        
        	$('#form').validate({
		        focusInvalid: true,
		        onfocusout: function(element){ 
		          	$(element).valid(); 
				},
		    	onkeyup: function(element){ 
		    		$(element).valid(); 
				},
		        errorPlacement: function(error, element) {
		        	element.parent().parent().addClass('error');
		        },
		        success: function(callback, element) {
					$(element).parent().parent().removeClass('error');
				},
				submitHandler: function(form){
					$('#btn-save').attr('disabled',true);
					$('#description').val(CHelper.filterXSS(ue.getContent()));
					CHelper.asynRequest('/user/edit', $('#form').serialize(), {
						before: function(xhr){},
						success: function(response){
							$('#btn-save').attr('disabled',false);
					        $.jGrowl('修改成功');
					    },
					    failure: function(msg){
					    	$('#btn-save').attr('disabled',false);
					        $.jGrowl('系统异常，请重试');
						},
						error: function(msg){
					    	$('#btn-save').attr('disabled',false);
					        $.jGrowl('系统异常，请重试');
						},
					});
				}
			});  
			
			var uploader = Qiniu.uploader({
		        runtimes: 'html5,flash,html4',
		        browse_button: 'pickfiles',
		        container: 'portrait_container',
		        drop_element: 'portrait_container',
		        flash_swf_url: '/library/qiniu/Moxie.swf',
		        uptoken_url: '/resource/token',
		        domain: qiniuDomain,
		        filters: [{title: 'image', extensions: 'jpg,jpeg,gif,png,bmp'}],
		        max_file_size: '2mb',
		        auto_start: true,
		        dragdrop: true,
		        unique_names: true,
		        multi_selection: false,
		        init: {
		            'FileUploaded': function(up, file, info) {
		            	var res = $.parseJSON(info);
		            	var url;
		            	if (res.url) {
					        url = res.url;
					    } else {
					        var domain = up.getOption('domain');
					        url = domain + encodeURI(res.key);
					    }
							    
					    var _image = Qiniu.imageInfo(res.key);
					    var scale = _image.width/_image.height;
					    if(scale < 0.8 || scale > 2) {
					    	$.jGrowl('请上传分辨率为200x200的图片');
					    	return;
					    }
					    
					    var data = {
					    	size: file.size,
					    	key: res.key,
					    	hash: res.hash,
					    	url: url,
					    	width: _image.width,
					    	height: _image.height				    	
					    }
							    
					    CHelper.asynRequest('/resource/create', data, {
							before: function(xhr){},
				            success: function(response){
				            	$('#portrait').val(url);
		            			$('#portrait_image').attr('src', url);
				            },
				            failure: function(msg){
				                $.jGrowl('图片上传失败，请重试');
				            }
						});
				    },
		            'Error': function(up, err, errTip) {
		            	$.jGrowl('图片上传失败，请重试');
		            }
		        }
		    });
		    
		    var bguploader = Qiniu.uploader({
		        runtimes: 'html5,flash,html4',
		        browse_button: 'background_pickfiles',
		        container: 'background_container',
		        drop_element: 'background_container',
		        flash_swf_url: '/library/qiniu/Moxie.swf',
		        uptoken_url: '/resource/token',
		        domain: qiniuDomain,
		        filters: [{title: 'image', extensions: 'jpg,jpeg,gif,png,bmp'}],
		        max_file_size: '2mb',
		        auto_start: true,
		        dragdrop: true,
		        unique_names: true,
		        multi_selection: false,
		        init: {
		            'FileUploaded': function(up, file, info) {
		            	var res = $.parseJSON(info);
		            	var url;
		            	if (res.url) {
					        url = res.url;
					    } else {
					        var domain = up.getOption('domain');
					        url = domain + encodeURI(res.key);
					    }
							    
					    var _image = Qiniu.imageInfo(res.key);
					    var scale = _image.width/_image.height;
					    if(scale < 1 || scale > 2) {
					    	$.jGrowl('请上传分辨率为1280x480的图片');
					    	return;
					    }
					    
					    var data = {
					    	size: file.size,
					    	key: res.key,
					    	hash: res.hash,
					    	url: url,
					    	width: _image.width,
					    	height: _image.height				    	
					    }
							    
					    CHelper.asynRequest('/resource/create', data, {
							before: function(xhr){},
				            success: function(response){
				            	$('#background').val(url);
		            			$('#background_image').attr('src', url);
				            },
				            failure: function(msg){
				                $.jGrowl('图片上传失败，请重试');
				            }
						});
				    },
		            'Error': function(up, err, errTip) {
		            	$.jGrowl('图片上传失败，请重试');
		            }
		        }
		    });
        });
STR;
    $cs->registerScript('edit-info', $js, CClientScript::POS_END);
?>
