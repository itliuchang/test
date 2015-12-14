 $(function(){
    	var ue = UE.getEditor('ueditor_container', {
		    autoHeight: true,
		});
		ue.ready(function(){
			ue.setContent($('#introduction').val());
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
					CHelper.asynRequest('/company/edit', $('#edit_base_form').serialize(), {
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
			browse_button : 'selectlogo', 
			container: document.getElementById('logo_container'),
			flash_swf_url : 'lib/plupload-2.1.2/js/Moxie.swf',
			silverlight_xap_url : 'lib/plupload-2.1.2/js/Moxie.xap',

		    url : 'http://oss.aliyuncs.com',

			init: {
				PostInit: function() {
					document.getElementById('osslogo').innerHTML = '';
					document.getElementById('postlogo').onclick = function() {
		            set_upload_param(uploader);
		            uploader.start();
		            return false;
					};
				},

				FilesAdded: function(up, files) {
					plupload.each(files, function(file) {
						document.getElementById('osslogo').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ')<b></b>'
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
		                $('#logo').val(host+'/img/'+up.id);
		            	$('#logo_img').attr('src', host+'/img/'+up.id);
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