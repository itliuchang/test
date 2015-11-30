(function() {
	jQuery.fn.extend({
	    uploadPreview: function (opts, callback) {
	        var _self = this, _this = $(this);
	        opts = jQuery.extend({
	            id: '',
	            message: '请选择正确的图片',
	            type: ['gif', 'jpeg', 'jpg', 'bmp', 'png']	            
	        }, opts || {});
	        callback = callback || {};
	        _self.getObjectURL = function (file) {
	            var url = null;
	            if (window.createObjectURL != undefined) {
	                url = window.createObjectURL(file);
	            } else if (window.URL != undefined) {
	                url = window.URL.createObjectURL(file);
	            } else if (window.webkitURL != undefined) {
	                url = window.webkitURL.createObjectURL(file);
	            }
	            return url;
	        };
	        _this.change(function () {
	            if (this.value) {
	                if (!RegExp("\.(" + opts.type.join("|") + ")$", "i").test(this.value.toLowerCase())) {
	                	if(typeof callback.error == 'function') {
	                		callback.error();
	                	} else {
	                		this.value = '';
	                		alert(opts.message);
	                	}
	                    return false;
	                }
	                
	                if(typeof callback.before == 'function') {
	                	if(!callback.before()) {
	                		return false;
	                	}
	                }
	                
	                if ($.browser.msie) {
	                    try {
	                        $("#" + opts.id).attr('src', _self.getObjectURL(this.files[0]));
	                    } catch (e) {
	                        var src = "";
	                        var obj = $("#" + opts.id);
	                        var div = obj.parent("div")[0];
	                        _self.select();
	                        if (top != self) {
	                            window.parent.document.body.focus();
	                        } else {
	                            _self.blur();
	                        }
	                        src = document.selection.createRange().text;
	                        document.selection.empty();
	                        obj.hide();
	                        obj.parent("div").css({
	                            'filter': 'progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)',
	                        });
	                        div.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = src;
	                    }
	                } else {
	                    $("#" + opts.id).attr('src', _self.getObjectURL(this.files[0]));
	                }
	                if(typeof callback.finished == 'function') {
	                	callback.finished();
	                }
	            }
	        });
	    }
	});
}).call(this);