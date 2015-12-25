<input id="action-type" type='hidden' value='<?php echo $this->action->id ?>'/>
<form id='edit_base_form' method="post" action="/room/editinfo" style='margin-bottom: 0;'>
<div class='row-fluid'>
	<div class='span3 box'>
		<div class='box-content'>
			<?php if($data['picture']):?>
				<img id='background_img' style='width:230px;height:150px;' src='<?php echo $data['picture'] ?>' />
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
			<input type='hidden' id='background' name='background' value='<?php echo $data['picture'] ?>'/>
			
			<fieldset>
				<div class='span11'>
					<div class='control-group'>
						<div class='lead'>
							<i class='icon-signin text-contrast'></i> 会议室信息
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>名称 <span class='text-red'>*</span></label>
						<div class='controls'>
							<input class='span4' name='name' type='text' value='<?php echo $data['name'] ?>' data-rule-required='true'/>
						</div>
					</div>
					
					<div class='control-group'>
						<label class='control-label'>所属中心 </label>
						<div class='controls'>
							<select name='hub'>
							<?php foreach($hub as $list): ?>
								<option value='<?php echo $list['id']?>' <?php echo $data['hubId']==$list['id']?'selected=selected':''?>><?php echo $list['location']?></option>
							<?php endforeach;?>
							</select>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>价格</label>
						<div class='controls'>
							<div class='input-append form_datepicker date'>
								<input name="price"  value='<?php echo $data['price']?>' type='number' style='width:130px;'/>
							</div>
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>座位数</label>
						<div class='controls'>
							<input class='span3' name='seats' type='number' value='<?php echo $data['seats'] ?>' />
						</div>
					</div>
					<div class='control-group'>
						<label class='control-label'>楼层</label>
						<div class='controls'>
							<input class='span3' name='floor' type='number' value='<?php echo $data['floor']?>' />
						</div>
					</div>
				</div>
			
			</fieldset>
			<div style='margin-bottom: 0;'>
				<div class='text-left'>
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
					CHelper.asynRequest('/room/edit', $('#edit_base_form').serialize(), {
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
			browse_button : 'selectbackground', 
			container: document.getElementById('background_container'),
			flash_swf_url : 'lib/plupload-2.1.2/js/Moxie.swf',
			silverlight_xap_url : 'lib/plupload-2.1.2/js/Moxie.xap',

		    url : 'http://oss.aliyuncs.com',

			init: {
				PostInit: function() {
					document.getElementById('ossbackground').innerHTML = '';
					document.getElementById('postbackground').onclick = function() {
		            set_upload_param(uploader);
		            uploader.start();
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
		            if (info.status >= 200 || info.status < 200){
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
 		uploader.init();

    });
STR;
    $cs->registerScript('edit-info', $js, CClientScript::POS_END);
?>
