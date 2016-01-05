(function(exports){
    Date.prototype.Format = function(fmt){
        var o = {
            "M+": this.getMonth() + 1,
            "d+": this.getDate(),
            "h+": this.getHours(),
            "m+": this.getMinutes(),
            "s+": this.getSeconds(),
            "q+": Math.floor((this.getMonth() + 3) / 3),
            "S": this.getMilliseconds()
        };
        if(/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
        for(var k in o)
        if(new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
        return fmt;
    };

    CHelper = {
          getQiniuDomain: function(imgSrc, extend){
                var res = '';
                if(/^https?:/i.test(imgSrc)){
                    res = imgSrc;
                }else{
                    res = qnDomain + '/' + imgSrc;
                }
                extend = extend || '';
                return (extend == '')? res : res + '?' + extend;
          },

        //七牛上传配置
         qiniuUpdate: function(token,options,callback){
            var defaults = {
                'browse_button':'pickfiles',
                'container':'add',
                'max_file_size':'12mb',
                'drop_element':'container',
                'fileuploadOptions':{
                    'imgsize':'w/200/h/200',
                    'liClass':'newImg col-xs-3',
                }
            };
            options = $.extend(true,{}, defaults, options || {});
            var callback = callback || {};
            var uploader = Qiniu.uploader({
                runtimes: 'html5,flash,html4',    //上传模式,依次退化
                browse_button: options.browse_button,       //上传选择的点选按钮，**必需**
                uptoken: token,
                    //Ajax请求upToken的Url，**强烈建议设置**（服务端提供）
                // uptoken : '<Your upload token>',
                    //若未指定uptoken_url,则必须指定 uptoken ,uptoken由其他程序生成
                unique_names: true,
                    // 默认 false，key为文件名。若开启该选项，SDK会为每个文件自动生成key（文件名）
                // save_key: true,
                    // 默认 false。若在服务端生成uptoken的上传策略中指定了 `sava_key`，则开启，SDK在前端将不对key进行任何处理
                domain: options.domain,
                    //bucket 域名，下载资源时用到，**必需**
                container: options.container,           //上传区域DOM ID，默认是browser_button的父元素，
                max_file_size: options.max_file_size,           //最大文件体积限制
                flash_swf_url: 'js/plupload/Moxie.swf',  //引入flash,相对路径
                max_retries: 3,                   //上传失败最大重试次数
                dragdrop: true,                   //开启可拖曳上传
                drop_element: options.drop_element,        //拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
                chunk_size: '4mb',                //分块上传时，每片的体积
                auto_start: true,                 //选择文件后自动上传，若关闭需要自己绑定事件触发上传
                init: {
                    'FilesAdded': function(up, files) {
                        if(typeof callback.FilesAdded == 'function')
                            callback.FilesAdded(up,files);
                        else
                            plupload.each(files, function(file) {
                                 // 文件添加进队列后,处理相关的事情
                            });
                    },
                    'BeforeUpload': function(up, file) {
                        // 每个文件上传前,处理相关的事情
                        if(typeof callback.BeforeUpload == 'function')
                            callback.BeforeUpload(up,file);
                        else
                            CHelper.toggleTip('show', '上传中(<span style="color:#EA2424;">0%</span>)..', 'loader');
                    },
                    'UploadProgress': function(up, file) {
                        // 每个文件上传时,处理相关的事情
                        if(typeof callback.UploadProgress == 'function')
                            callback.UploadProgress(up,file);
                        else
                            $('#tipModal[data-type=loader] .hint span').text(file.percent + '%');
                    },
                    'FileUploaded': function(up, file, info) {
                           // 每个文件上传成功后,处理相关的事情
                           // 其中 info 是文件上传成功后，服务端返回的json，形式如
                           // {
                           //    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
                           //    "key": "gogopher.jpg"
                           //  }
                           // 参考http://developer.qiniu.com/docs/v6/api/overview/up/response/simple-response.html
                           if(typeof callback.FileUploaded == 'function')
                               callback.FileUploaded(up,file);
                           else{
                               var domain = up.getOption('domain'),
                                   res = $.parseJSON(info),
                                   sourceLink = domain + '/'+res.key+"?imageView2/1/"+options.fileuploadOptions.imgsize; //获取上传成功后的文件的Url
                                   imgurl = "<li class='"+options.fileuploadOptions.liClass+"'><img class='thumbnail' src='"+sourceLink+"'></li>";
                                   CHelper.toggleTip('hide');
                                   $('.'+options.container).before(imgurl);
                                var imginfo = Qiniu.imageInfo(res.key);
                                    size = file.size,
                                    key = res.key,
                                    hash = res.hash,
                                    url = domain + '/' + res.key,
                                    width = imginfo.width,
                                    height = imginfo.height;
                                CHelper.asynRequest('/resource/metadata',{
                                    'size' : size,
                                    'key' : key,
                                    'hash' : hash,
                                    'link' : key,
                                    'width' : width,
                                    'height' : height
                                    },{
                                      before:function(xhr){
                                      },
                                      error:function(msg){
                                         CHelper.toggleTip('show', msg , 'error', 1000);
                                      },
                                      success:function(msg){
                                      }

                                    });

                           }
                           
                    },
                    'Error': function(up, err, errTip) {
                           //http://developer.qiniu.com/docs/v6/api/reference/codes.html
                           //上传出错时,处理相关的事情
                           if(err.code == -600) {
                             CHelper.toggleTip('show','文件大小超过限制','error',1000);
                           }else{
                             CHelper.toggleTip('show',errTip,'error',1000);
                           }
                    },
                    'UploadComplete': function() {
                           //队列文件处理完毕后,处理相关的事情
                    },
                    'Key': function(up, file) {
                        // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
                        // 该配置必须要在 unique_names: false , save_key: false 时才生效
                        var key = "";
                        // do something with key here
                        return key;
                    }
                }
            });
        },
        //阿里云上传配置
        uploadOSS: function(token,options,callback){
            var defaults = {
                'browse_button':'selectfiles',
                'container':'container',
                'max_file_size':'12mb',
                'url':'http://naked.oss-cn-shanghai.aliyuncs.com'
            };
            options = $.extend(true,{}, defaults, options || {});
            token = token;
            var callback = callback || {};
            var uploader = new plupload.Uploader({
                runtimes : 'html5,flash,silverlight,html4',
                browse_button : options.browse_button, 
                container: options.container,
                flash_swf_url : 'lib/plupload-2.1.2/js/Moxie.swf',
                silverlight_xap_url : 'lib/plupload-2.1.2/js/Moxie.xap',
                unique_names: true,
                multi_selection:false,
                auto_start: true,
                filter:{
                    max_file_size:'5mb',
                    mime_types:[{
                        title:'图片类型',
                        extensions:'jpg,png'
                    }]
                },
                url : options.url,
                multipart_params : {
                    'key':token.key,
                    'policy':token.policy,
                    'OSSAccessKeyId':token.OSSAccessKeyId,
                    'success_action_status':'200',
                    'signature':token.signature
                },

                init: {
                    PostInit: function(){
                        uploader.setOption('multipart_params',{
                            'key':'img/'+uploader.id,
                            'policy':token.policy,
                            'OSSAccessKeyId':token.OSSAccessKeyId,
                            'success_action_status':'200',
                            'signature':token.signature
                        });

                    },

                    FilesAdded: function(up, files) {
                        // console.log(up);
                        
                        plupload.each(files, function(file) {
                            CHelper.toggleTip('show', '上传中(<span style="color:#EA2424;">0%</span>)..', 'loader');
                            uploader.start(); 
                        });                                       
                    },

                    UploadProgress: function(up, file) {
                         // 每个文件上传时,处理相关的事情
                        if(typeof callback.UploadProgress == 'function')
                            callback.UploadProgress(up,file);
                        else{
                            $('#tipModal[data-type=loader] .hint span').text(file.percent + '%');
                        }
                        
                    },

                    FileUploaded: function(up, file, info) {
                        if(typeof callback.FileUploaded == 'function')
                           callback.FileUploaded(up,file);
                       else
                            CHelper.toggleTip('hide');
                        
                    },

                    Error: function(up, err) {
                        console.log(err.response)
                    }
                }
            });
            uploader.init();
        },
        getXDate: function(start, days){
            start = start.toString().length == 10? start * 1000 : start;
            var s = new Date(start);
            s.setDate(s.getDate() + days);
            return s.getTime();
        },

        getPayURL: function(orderID, payType){
            payType = payType || 1;
            var url = '';
            switch(payType){
                case 1:
                    url = '/payment/wxpay/jsapi/pay-' + orderID + '.html';
                    break;
            }
            return url;
        },

        checkIsLogin: function(isReturn){
            if(isReturn){
                return !isGuest;
            }else if(isGuest){
                if(CHelper.isWeixin()){
                    var url = encodeURIComponent(location.href);
                    location.href = '/wechat/login.html?returnurl=' + url;
                }else{
                    CHelper.toggleTip('show', '请在微信客户端访问。', 'warn', 1200);
                }
                return false;
            }else{
                return true;
            }
        },

        checkPhoneNum: function(tel){
            return /^0?1[3|4|5|6|7|8][0-9]\d{8}$/.test(tel);
        },

        checkDate: function(d){
            return /^\d{4}(\-|\/)\d{1,2}\1\d{1,2}$/.test(d);
        },

        isTrue: function(v){
            return v === true || v === 'true';
        },
        
        isObject: function(v){
            return typeof v === 'object';
        },
        
        isFunction: function(v){
            return typeof v === 'function';
        },
        
        isString: function(v){
            return typeof v === 'string';
        },
        
        isArray: function(v){
            return this.type(v) === 'array';
        },
        
        isNumeric: function(v){
            return !isNaN(parseFloat(v)) && isFinite(v);
        },
        
        type: function(v){
            if(v === null) return String(v);
            return this.isObject(v) || this.isFunction(v)? this.toString.call(v).slice(8, -1).toLowerCase() || 'object' : typeof v;
        },
        
        isEmptyObject: function(v){
            /*jslint unused: false */
            for(var i in v) return false;
            return true;
        },

        //i: from where to begin, if no then -1
        inArray: function(item, array, i){
            if(this.isArray(array)){
                try{
                    return [].indexOf.call(array, item, i);
                }catch(e){
                    var len = array.length;
                    i = i? (i < 0? Math.max(0, len + i) : i) : 0;
                    for(; i < len; i++){
                        if(i in array && array[i] === item) return i;
                    }
                }
            }
            return -1;
        },

        stopPropagation: function(e){
            e = e || window.event;
            if(e.stopPropagation){
                e.stopPropagation();
            }else{
                e.cancelBubble = true; // for IE
            }
        },

        extend: function(){
            var target = arguments[0], n = 1, source;
            if(arguments.length === 1){
                target = this;
                n = 0;
            }
            /* jshint boss: true */
            while(source = arguments[n++]){
                for(var prop in source) target[prop] = source[prop];
            }
            return target;
        },

        extend2: function(target, source, e, o, d){
            function assign(_this, prop){
                if(d && _this.isObject(source[prop]) && _this.isObject(target[prop])){
                    target[prop] = _this.extend2(target[prop] || {}, source[prop], e, o, d);
                }else{
                    target[prop] = source[prop];
                }
            }
            
            for(var prop in source){
                if(e){
                    if(!target.hasOwnProperty(prop) || (d && this.isObject(source[prop]))) assign(this, prop);
                }else if(!o || target.hasOwnProperty(prop)){
                    assign(this, prop);
                }
            }
            return target;
        },

        createInstance: function(o){
            /*jslint evil: true */
            var f = new Function();
            f.prototype = o;
            /*jslint supernew: true */
            o = new f;
            f.prototype = null;
            return o;
        },
        
        inherits: function(subClass, superClass){
            var sub = subClass.prototype,
                _super = this.createInstance(superClass.prototype);
            this.extend(_super, sub);
            subClass.prototype = _super;
            return (_super.constructor = subClass);
        },

        clone: function(source, target){
            var temp;
            target = target || {};
            for(var i in source){
                if(source.hasOwnProperty(i)){
                    temp = source[i];
                    if(this.isObject(temp)){
                        target[i] = this.isArray(temp)? [] : {};
                        //arguments.callee(temp, target[i]);
                        this.clone(temp, target[i]);
                    }else{
                        target[i] = temp;
                    }
                }
            }
            return target;
        },

        parseJSON: function(data, callback){
            if(this.isObject(data)) return data;
            var result = {};
            try{
                result = JSON.parse(data);
                if(!this.isObject(result)) throw new Error('Illegal JSON String');
            }catch(e){
                result = {};
                if(this.isFunction(callback)) callback(e.message, e.stack);
            }
            return result;
        },
        
        stringify: function(data){
            return JSON.stringify(data);
        },

        stripTags: function(content){
            content = (content || '').replace(/<[^>]+>/igm, '').replace(/\r?\n/igm, '<br/>');
            return content.replace(/<br\/?>|\s/ig, '') === ''? '' : content.trim();
        },
        
        stripSpace: function(content){
            return (content || '').replace(/\s+/igm, '');
        },

        stripSpace2: function(content){
            return this.stripSpace((content || '').replace(/&nbsp;/igm, ' '));
        },
        
        trim: function(content){
            return (content || '').trim();
        },
        
        getPlain: function(content){
            return this.stripTags(content).trim();
        },

        html: function(content){
            content = (content || '').replace(/&nbsp;/igm, ' ').trim();
            return content? content.replace(/&((g|l|quo)t|amp|#39);/g, function(m){
                return {
                    '&lt;':'<',
                    '&amp;':'&',
                    '&quot;':'"',
                    '&gt;':'>',
                    '&#39;':"'"
                }[m];
            }) : '';
        },
        
        unhtml: function(content, reg){
            content = this.trim(content);
            return content? content.replace(reg || /[&<">'](?:(amp|lt|quot|gt|#39|nbsp);)?/g, function(a, b){
                if(b){
                    return a;
                }else{
                    return {
                        '<':'&lt;',
                        '&':'&amp;',
                        '"':'&quot;',
                        '>':'&gt;',
                        "'":'&#39;'
                    }[a];
                }
            }) : '';
        },

        unhtml2: function(content, reg){
           content = this.trim(content);
           content = content? content.replace(/&((g|l|quo)t|amp|#39);/g, function(m){
                return {
                    '&lt;':'&amp;lt;',
                    '&amp;':'&amp;amp;',
                    '&quot;':'&amp;quot;',
                    '&gt;':'&amp;gt;',
                    '&#39;':"&amp;#39;"
                }[m];
            }) : '';
            return this.unhtml(content.replace(/&nbsp;/igm, '&amp;nbsp;'), reg).replace(/\s/igm, '&nbsp;');
        },

        hasClass: function(dom, className){
            if(!dom || (this.isObject(dom) && dom.nodeType !== 1)) return false;
            var classList = this.isString(dom)? dom : dom.className,
                rclass = /[\t\r\n\f]/g;
            classList = ' ' + classList.replace(rclass, ' ') + ' ';
            className = ' ' + this.stripSpace(className) + ' ';
            return classList.indexOf(className) >= 0;
        },
        
        insertAfter: function(newDom, targetDom){
            var parentDom = targetDom.parentNode;
            if(parentDom.lastChild === targetDom){
                parentDom.appendChild(newDom);
            }else{
                parentDom.insertBefore(newDom, targetDom.nextSibling);
            }
        },

        getStyle: function(dom, key){
            if(dom.style[key]){
                return dom.style[key];
            }else if(dom.currentStyle){
                return dom.currentStyle[key];
            }else if(document.defaultView && document.defaultView.getComputedStyle){
                key = key.replace(/([A-Z])/g, '-$1').toLowerCase();
                return document.defaultView.getComputedStyle(dom, null).getPropertyValue(key);
            }
            return null;
        },

        $: function(select){
            return document.querySelector(select);
        },

        getRandomLetters: function(len){
            var tmp = '';
            for(var i = 0; i < len; i++) tmp += String.fromCharCode(Math.floor(Math.random() * 26) + 'a'.charCodeAt(0));
            return tmp;
        },

        setVisible: function(dom, isDisplay){
            dom.style.visibility = isDisplay? 'visible' : 'hidden';
        },
        
        isTagNode: function(node, name){
            //return new RegExp('^' + node.tagName + '$','i').test(name);
            return node.nodeType === 1 && new RegExp('^' + node.nodeName + '$', 'i').test(name);
        },
        
        getPosition: function(dom){
            var left = dom.offsetLeft,
                top = dom.offsetTop,
                current = dom.offsetParent;
            while(current !== null){
            　　left += current.offsetLeft;
                top += current.offsetTop;
                current = current.offsetParent;
            }
            return {left: left, top: top};
        },

        getWidth: function(dom){
            var w = parseFloat(dom.style.width) || dom.width || dom.offsetWidth;
            if(w && w > 0) return w;
            return Math.max(dom.scrollWidth, dom.clientWidth, parseFloat(dom.style.width) || 0);
        },
        
        getHeight: function(dom){
            var h = parseFloat(dom.style.height) || dom.height || dom.offsetHeight;
            if(h > 0) return h;
            return Math.max(dom.scrollHeight, dom.clientHeight, parseFloat(dom.style.height) || 0);
        },

        slideTo: function(target, speed){
            if(!speed) speed = 100;
            if(target < 5) target = 5;
            var pos = target - 5, current_pos = document.body.scrollTop, distance = pos - current_pos, duration = Math.abs(distance) / speed;
            var it = setInterval(function(){
              if(distance > 0){
                current_pos = current_pos + duration;
                if(current_pos >= pos){
                  current_pos = pos;
                  clearInterval(it);
                }
              }else{
                current_pos = current_pos - duration;
                if(current_pos <= pos){
                  current_pos = pos;
                  clearInterval(it);
                }
              }
              document.body.scrollTop = current_pos;
            }, 1);
        },

        scrollTo: function(sel){
            $('html, body').stop(true).animate({scrollTop: $(sel).offset().top}, 1000);
        },

        //https://github.com/leizongmin/js-xss
        //https://github.com/leizongmin/js-xss/blob/master/README.zh.md
        //http://jsxss.com/zh/index.html
        filterXSS: function(html){
            return html && filterXSS(html, {
                allowCommentTag: false,
                whiteList: $.extend(filterXSS.whiteList, {}),
                onIgnoreTagAttr: function(tag, name, value, isWhiteAttr){
                    if(name === 'style'){
                        value = filterXSS.safeAttrValue(tag, name, value);
                        return value? name + '="' + value + '"' : name;
                    }
                }
            });
        },

        removeEmoji: function(content){
            return content.replace(/^\:[a-z0-9_]+\:$/i, '');
        },

        isWeixin: function(){
          return /MicroMessenger/i.test(navigator.userAgent);
        },

        isQQBrowser: function(){
          return !CHelper.isWeixin() && /MQQBrowser/i.test(navigator.userAgent);
        },

        sprintf: function(){
            var arg = arguments,
                str = arg[0] || '',
                i, n;
            for(i = 1, n = arg.length; i < n; i++) str = str.replace(/%s/, arg[i]);
            return str;
        },

        count: function(o){
            var t = typeof o, n = 0;
            switch(t.toLowerCase()){
                case 'string': n = o.length;break;
                case 'object':
                    for(var k in o){
                        if(o.hasOwnProperty(k)) n++;
                    }
                    break;
            }
            return n;
        },

        clone: function(obj, deep){
            return deep === true? $.extend(true, {}, obj): $.extend({}, obj);
        },

        getQueryString: function(key){
            var reg = new RegExp('(^|&)' + key + '=([^&]*)(&|$)', 'i'),
                r = location.search.substr(1).match(reg);
            return r? unescape(decodeURI(r[2])) : '';
        },

        calElemHeight: function(elem, minHeight, sub, isReturn){
            var height = $(window).height() - $(elem).offset().top;
            if(typeof sub == 'number') height -= sub;
            if(typeof minHeight == 'number' && height < minHeight) height = minHeight;
            if(isReturn){
                return height;
            }else{
                $(elem).height(height);
            }
        },

        dgm: function(datetime){
          if((typeof datetime == 'string' && datetime.length == 10) || typeof datetime == 'number'){
              datetime = parseInt(datetime);
              datetime = datetime.toString().length == 10? datetime * 1000 : datetime;
          }else{
              datetime = datetime.toString().replace(/-/g, '/');
          }
          var date = new Date(datetime) == 'Invalid Date'? new Date : new Date(datetime),
              tday = Math.floor((new Date).getTime()/86400000 - date.getTime()/86400000),
              from = Math.round(date.getTime() / 1000),
              now = Math.round((new Date).getTime() / 1000),
              time = now - from;
          if(tday == 0){
              if(time > 3600){
                  return Math.floor(time / 3600) + 'h'; //小时前
              }else if(time > 60){
                  return Math.floor(time / 60) + 'min'; //分钟前
              }else if(time > 0){
                  return time + 's'; //秒前
              }else{
                  return 'now'; //刚刚
              }
          }else{
              var ftime = date.Format("MM-dd"), //MM月dd日
                  _now = new Date;
              date.setHours(0);date.setMinutes(0);date.setSeconds(0);date.setMilliseconds(0);
              _now.setHours(0);_now.setMinutes(0);_now.setSeconds(0);_now.setMilliseconds(0);
              var _time = Math.round((_now.getTime() - date.getTime()) / 1000);
                  dday = Math.ceil(_time / 86400);
              if(dday > 0 && dday < 7){
                // if(dday <= 2){
                //     return dday == 1? '昨天' : '前天';
                if(dday <= 1){
                    return 'yesterday';
                }else{
                    return dday + ' days'; //天前
                }
              }else{
                  return ftime;
              }
          }
        },

        dgm2: function(cur, end){
          var interval = Math.floor((end - cur) / 1000),
              res = {'day': '00', 'hour': '00', 'minute': '00'};
          if(interval > 0){
            var oneDay = 86400.0;
            res['day'] = Math.floor(interval / oneDay);
            var remain = interval - (res['day'] * oneDay);

            var oneHour = 3600.0;
            res['hour'] = Math.floor(remain / oneHour);
            remain -= res['hour'] * oneHour;

            oneMinute = 60.0;
            res['minute'] = Math.floor(remain / oneMinute);

            if(res['day'] < 10) res['day'] = '0' + res['day'];
            if(res['hour'] < 10) res['hour'] = '0' + res['hour'];
            if(res['minute'] < 10) res['minute'] = '0' + res['minute'];
          }
          return res;
        },

        dataFormat: function(timestamp, format){
            timestamp = timestamp.toString().length == 10? timestamp * 1000 : timestamp;
            return (new Date(timestamp)).Format(format);
        },

        popover: function(selector, action, title, content, timeout){
            action = action || 'show';
            target = $(selector);
            if(action == 'show'){
                target.attr({'data-content': content, 'data-original-title': title}).popover('show');
                var timeout = timeout || 0;
                if(timeout > 0){
                    setTimeout(function(){CHelper.popover(selector, 'hide');}, timeout);
                }
            }else{
                target.popover('hide');
            }
        },

        // CHelper.prompt('show', null, 'test', 800)
        prompt: function(action, title, content, timeout){
            var _prompt = $('#prompt'), action = action || 'show';
            if(action == 'show'){
                var _top = document.documentElement.clientHeight + document.body.scrollTop;
                _prompt.css({'top' : _top}).attr({'data-content': content, 'data-original-title': title}).popover('show');
                timeout = timeout || 0;
                if(timeout > 0){
                    setTimeout(function(){CHelper.prompt('hide');}, timeout);
                }
            }else{
                _prompt.popover(action);
            }
        },

        // CHelper.toggleTip('show', null, null, 800, function(){console.info('test')})
        toggleTip: function(action, title, icon, timeout, callback){
            var _modal = $('#tipModal');
            action = action || 'show';
            if(action == 'show'){
                title = title || 'Success!';
                icon = icon || 'success';
                _modal.attr('data-type', icon).find('.tip-form .hint').html(title);
                timeout = timeout || 0;
                if(timeout > 0){
                    setTimeout(function(){
                        CHelper.toggleTip('hide', null, null, null, callback);
                    }, timeout);
                }
            }else{
                if(typeof callback == 'function'){
                    setTimeout(function(){callback()}, 500);
                }
            }
            _modal.modal(action);
        },

        toggleMTip: function(action, type, timeout, callback){
          var _modal = $('#modalTip');
          action = action || 'show';
          if(action == 'show'){
            type = type || 'share';
            _modal.attr('data-type', type);
            timeout = timeout || 0;
            if(timeout > 0){
              setTimeout(function(){
                helper.toggleMTip('hide', null, null, null, callback);
              }, timeout);
            }
          }else{
            if(typeof callback == 'function'){
              setTimeout(function(){callback()}, 500);
            }
          }
          _modal.modal(action);
        },

        caches: {},
        doing: {},
        asynRequest: function(url, data, callback, useCache, notMultiple, key){
            notMultiple = notMultiple === false? false : true;
            callback = callback || {};
            key = key || url;
            if(this.doing[key] === true && notMultiple) return;
            
            if(typeof callback.init == 'function'){
                callback.init();
            }

            if(useCache && this.caches[url]){
                return this.caches[url];
            }else if(this.caches[url]){
                delete this.caches[url];
            }

            this.doing[key] = true;

            data = data || {};
            var parameter = data.parameter || {};
            $.extend(data,parameter.data || {});
            var requestType = parameter.type || 'POST',
                dataType = parameter.dataType || 'json',
                requestCache = parameter.cache || false;
            delete data.parameter;
            if(requestType == 'POST') data.YII_CSRF_TOKEN = $('#_csrftoken').val();
            $.ajax(url, {
                type: requestType, dataType: dataType, cache: requestCache, data: data,
                beforeSend: function(xhr){
                  if(typeof callback.before == 'function'){
                      callback.before(xhr);
                  }else{
                      CHelper.prompt('show', null, 'In Progress...');
                  }
                },
                success: function(response, status){
                    if(response && status == 'success'){
                        if(response.code == 200){
                            if(useCache) CHelper.caches[url] = response.data || {};
                            if(typeof callback.success == 'function'){
                                if(callback.successReturnAll === true){
                                    callback.success(response || {});
                                }else{
                                    callback.success(response.data || {});
                                }
                            }else{
                                CHelper.prompt('show', null, 'Success!');
                            }
                        }else{
                            if(typeof callback.failure == 'function'){
                                callback.failure(response);
                            }else{
                                if(response.code == 401){
                                    CHelper.toggleTip('show', 'please login', 'warn', 800);
                                }else if(response.code == 403){
                                    CHelper.toggleTip('show', 'forbidden', 'warn', 800);
                                }else{
                                    CHelper.toggleTip('show', 'status error', 'warn', 800);
                                }
                            }
                        }
                    }else{
                        if(typeof callback.refuse == 'function'){
                            callback.refuse(response);
                        }else{
                            CHelper.prompt('show', null, 'data error');
                        }
                    }
                },
                complete: function(xhr, status){
                    delete CHelper.doing[key];
                    if(typeof callback.complete == 'function'){
                        callback.complete(status);
                    }else{
                        setTimeout(function(){
                            CHelper.prompt('hide');
                        }, 1800);
                    }
                },
                error: function(xhr, msg, eThrow){
                  if(typeof callback.error == 'function'){
                      callback.error(msg);
                  }else{
                      CHelper.prompt('show', null, 'internal error');
                  }
                },               
            });
        }
    };

    template.helper('filterXSS', CHelper.filterXSS);
    template.helper('dgm', CHelper.dgm);
    template.helper('dgm2', CHelper.dgm2);
    template.helper('dataFormat', CHelper.dataFormat);
    template.helper('getXDate', CHelper.getXDate);
    template.helper('getPayURL', CHelper.getPayURL);
    template.helper('getQiniuDomain', CHelper.getQiniuDomain);
})(window);