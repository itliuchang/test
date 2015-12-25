<input id="action-type" type='hidden' value='<?php echo $this->action->id ?>'/>
<form id='edit_base_form' method="post" action="/user/editinfo" style='margin-bottom: 0;'>
<div class='row-fluid'>
	<div class='span3 box'>
		<div class='box-content'>
			<?php if($data['portrait']):?>
				<img id='portrait_img' style='width:230px;height:230px;' src='<?php echo $data['portrait'] ?>' />
			<?php else:?>
				<img id='portrait_img' style='width:230px;height:230px;' src='http://naked.oss-cn-shanghai.aliyuncs.com/logo.png'>
			<?php endif;?>
		</div>
		<div style='margin-top: 15px;' id="portrait_container">
			<span id='ossportrait'></span>
			<a id="selectportrait" href="javascript:void(0);" class='upbtn'>选择头像</a>
			<a id="postportrait" href="javascript:void(0);" class='upbtn'>开始上传</a>
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
	<div class='span9 box'>
		<div class='box-content box-double-padding'>
			<input type='hidden' name='id' value='<?php echo $data['id'] ?>'/>
			<input type='hidden' id='portrait' name='portrait' value='<?php echo $data['portrait'] ?>'/>
			<input type='hidden' id='background' name='background' value='<?php echo $data['background'] ?>'/>
			
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
							<input class='span4' name='nickName' type='text' value='<?php echo $data['nickName'] ?>' data-rule-required='true'/>
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
							<div class='input-append form_datepicker date'>
								<input readonly data-format='yyyy-MM-dd' name="birthday"  value='<?php echo isset($data['birthday'])?substr($data['birthday'],0,10):""?>' type='text' style='width:130px;'/>
								<span class="add-on"><i class="icon-th"></i></span>
							</div>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>手机号</label>
						<div class='controls'>
							<input class='span6' name='mobile' data-rule-phoneus='true' type='text' value='<?php echo $data['mobile'] ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>电子邮件</label>
						<div class='controls'>
							<input class='span6' name='email' data-rule-email='true' type='text' value='<?php echo isset($data['email'])?$data['email']:"" ?>' />
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
							<input class='span4' name='work' type='text' value='<?php echo $data['work'] ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>用户类型</label>
						<div class='controls'>
							<select name='userType'>
							<?php foreach ($type as $list) :?>
								<option value="<?php echo $list['id']?>" <?php echo $list['id']==$data['userType']?'selected=selected':''?>><?php echo $list['name']?></option>
							<?php endforeach;?>
							</select>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>所属公司</label>
						<div class='controls'>
							<select name='company'>
							<?php foreach($company as $list) : ?>
								<option value="<?php echo $list['id']?>" <?php echo $list['id']==$data['company']?'selected=selected':''?>><?php echo $list['name']?></option>
							<?php endforeach;?>
							</select>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>公司职位</label>
						<div class='controls'>
							<select name='role'>
								<option value='1' <?php if($data['role']==1) echo 'selected=selected'?>>老板</option>
								<option value='2' <?php if($data['role']==2) echo 'selected=selected'?>>员工</option>
							</select>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>头衔</label>
						<div class='controls'>
							<input class='span4' name='title' type='text' value='<?php echo $data['title'] ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>关注</label>
						<div class='controls'>
							<input class='span2' name='followers' type='text' value='<?php echo $data['followers'] ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>常用办公地点 </label>
						<div class='controls'>
							<select name='location'>
								<?php foreach($hub as $list) : ?>
									<option value="<?php echo $list['id']?>" <?php $list['id']==$data['location']?'selected=selected':''?>><?php echo $list['location']?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>工作楼层</label>
						<div class='controls'>
							<input class='span2' name='floor' type='text' value='<?php echo $data['floor'] ?>' />楼
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>技能</label>
						<div class='controls'>
							<input class='span12' name='skills' type='text' value='<?php echo $data['skills'] ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>爱好</label>
						<div class='controls'>
							<input class='span12' name='interests' type='text' value='<?php echo $data['interests'] ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>个人网站</label>
						<div class='controls'>
							<input class='span6' name='website' type='text' value='<?php echo $data['website'] ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>Wechat</label>
						<div class='controls'>
							<input class='span6' name='wechat' type='text' value='<?php echo $data['wechatid'] ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>Facebook</label>
						<div class='controls'>
							<input class='span6' name='facebook' type='text' value='<?php echo $data['facebookid'] ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>Twitter</label>
						<div class='controls'>
							<input class='span6' name='twitter' type='text' value='<?php echo $data['twitterid'] ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>LinkedIn</label>
						<div class='controls'>
							<input class='span6' name='linkedin' type='text' value='<?php echo $data['linkedinid'] ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>Instagram</label>
						<div class='controls'>
							<input class='span6' name='instagram' type='text' value='<?php echo $data['instagramid'] ?>' />
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
			<div style='margin-bottom: 0;'>
				<div class='text-right'>
					<button id='btn-save' class='btn btn-primary btn-large' type='submit'> <i class='icon-save'></i> 保存 </button>
				</div>
			</div>
			
		</div>
	</div>
</div>
</form>
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
        
        	$('#edit_base_form').validate({
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
				$('#btn-save').attr('disabled', true);
			
				if($('#action-type').val()=='edit'){
					CHelper.asynRequest('/user/edit', $('#edit_base_form').serialize(), {
						before: function(xhr){},
						success: function(response){
					        $.jGrowl('修改成功');
					    },
					    failure: function(msg){
					        $.jGrowl('系统异常，请重试');
						},
						error: function(msg){
					        $.jGrowl('系统异常，请重试');
						},
					});
					$('#btn-save').attr('disabled',false);
				} else {
					form.submit();
				}
			}
		});

		$('.form_datepicker').datetimepicker({
		    language: 'zh-CN',
		    autoclose:true,
		    pickTime: false,
		}); 
			
		expire = 0
		function get_signature(){
	        $.ajax({
	        	url:'/resource/get',
	        	type:'GET',
	        	async:false,
	        	success:function(data){
	        		body=data;
	        	}
	        });
	        var obj = eval ("(" + body + ")");
	        host = obj['host']
	        policyBase64 = obj['policy']
	        accessid = obj['accessid']
	        signature = obj['signature']
	        expire = parseInt(obj['expire'])
	        key = obj['dir']
	        return true;
		    
		    return false;
		};

		function set_upload_param(up){
		    var ret = get_signature()
		    if (ret == true){
		        new_multipart_params = {
		            'key' : key + up.id,
		            'policy': policyBase64,
		            'OSSAccessKeyId': accessid, 
		            'success_action_status' : '200', //让服务端返回200,不然，默认会返回204
		            'signature': signature,
		        };
		        up.setOption({
		            'url': host,
		            'multipart_params': new_multipart_params
		        });
		    }
		}

		var uploader = new plupload.Uploader({
			runtimes : 'html5,flash,silverlight,html4',
			browse_button : 'selectportrait', 
			container: document.getElementById('portrait_container'),
			flash_swf_url : 'lib/plupload-2.1.2/js/Moxie.swf',
			silverlight_xap_url : 'lib/plupload-2.1.2/js/Moxie.xap',

		    url : 'http://oss.aliyuncs.com',

			init: {
				PostInit: function() {
					document.getElementById('ossportrait').innerHTML = '';
					document.getElementById('postportrait').onclick = function() {
		            set_upload_param(uploader);
		            uploader.start();
		            return false;
					};
				},

				FilesAdded: function(up, files) {
					plupload.each(files, function(file) {
						document.getElementById('ossportrait').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ')<b></b>'
						+'<div class="progress"><div class="progress-bar" style="width: 0%"></div></div>'
						+'</div>';
					});
				},

				UploadProgress: function(up, file) {
					var d = document.getElementById(file.id);
					d.getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		            
		            var prog = d.getElementsByTagName('div')[0];
					var progBar = prog.getElementsByTagName('div')[0]
					progBar.style.width= 2*file.percent+'px';
					progBar.setAttribute('aria-valuenow', file.percent);
				},

				FileUploaded: function(up, file, info) {
		            set_upload_param(up);
		            if (info.status >= 200 || info.status < 200){
		                document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = 'success';
		                $('#portrait').val(host+'/img/'+up.id);
		            	$('#portrait_img').attr('src', host+'/img/'+up.id);
		            }else{
		                document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = info.response;
		            } 
				},

				Error: function(up, err) {
		            set_upload_param(up);
				}
			}
		});
 		uploader.init();

		var bguploader = new plupload.Uploader({
			runtimes : 'html5,flash,silverlight,html4',
			browse_button : 'selectbackground', 
			container: document.getElementById('background_container'),
			flash_swf_url : 'lib/plupload-2.1.2/js/Moxie.swf',
			silverlight_xap_url : 'lib/plupload-2.1.2/js/Moxie.xap',

		    url : 'http://oss.aliyuncs.com',

			init: {
				PostInit: function() {
					document.getElementById('ossbackground').innerHTML = '';
					document.getElementById('postbackground').onclick = function() {
		            set_upload_param(bguploader);
		            bguploader.start();
		            return false;
					};
				},

				FilesAdded: function(up, files) {
					plupload.each(files, function(file) {
						document.getElementById('ossbackground').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ')<b></b>'
						+'<div class="progress"><div class="progress-bar" style="width: 0%"></div></div>'
						+'</div>';
					});
				},

				UploadProgress: function(up, file) {
					var d = document.getElementById(file.id);
					d.getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		            
		            var prog = d.getElementsByTagName('div')[0];
					var progBar = prog.getElementsByTagName('div')[0]
					progBar.style.width= 2*file.percent+'px';
					progBar.setAttribute('aria-valuenow', file.percent);
				},

				FileUploaded: function(up, file, info) {
		            set_upload_param(up);
		            if (info.status >= 200 || info.status < 200) {
		                document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = 'success';
		                $('#background').val(host+'/img/'+up.id);
		            	$('#background_img').attr('src', host+'/img/'+up.id);
		            }else{
		                document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = info.response;
		            } 
				},

				Error: function(up, err) {
		            set_upload_param(up);
				}
			}
		});

		bguploader.init();

        });
STR;
    $cs->registerScript('edit-info', $js, CClientScript::POS_END);
?>
