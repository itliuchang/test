(function(exports){
    Date.prototype.Format = function(fmt){
        var o = {
            "M+": this.getMonth() + 1, //月份 
            "d+": this.getDate(), //日 
            "h+": this.getHours(), //小时 
            "m+": this.getMinutes(), //分 
            "s+": this.getSeconds(), //秒 
            "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
            "S": this.getMilliseconds() //毫秒 
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
        getXDate: function(start, days){
            //var yesday = new Date(new Date()-24*60*60*1000); //昨天
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

        //登录判断
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

        //判断字符串是否为true
        isTrue: function(v){
            return v === true || v === 'true';
        },
        
        //判断是否为对象
        isObject: function(v){
            return typeof v === 'object';
        },
        
        //判断是否是函数
        isFunction: function(v){
            return typeof v === 'function';
        },
        
        isString: function(v){
            return typeof v === 'string';
        },
        
        isArray: function(v){
            //return v instanceof Array;
            //return Object.prototype.toString.call(v) == '[object Array]';
            return this.type(v) === 'array';
        },
        
        isNumeric: function(v){
            return !isNaN(parseFloat(v)) && isFinite(v);
        },
        
        type: function(v){
            if(v === null) return String(v);
            //type: Boolean Number String Function Array Date RegExp Object Error, etc
            return this.isObject(v) || this.isFunction(v)? this.toString.call(v).slice(8, -1).toLowerCase() || 'object' : typeof v;
        },
        
        isEmptyObject: function(v){
            /*jslint unused: false */
            for(var i in v) return false;
            return true;
        },

        //检查数组中是否存在该元素，i表示从哪个index开始查找。如果存在则返回index、否则返回-1
        inArray: function(item, array, i){
            if(this.isArray(array)){
                try{
                    return [].indexOf.call(array, item, i);
                }catch(e){
                    var len = array.length;
                    //i = i? i < 0? Math.max(0, len + i) : i : 0;
                    i = i? (i < 0? Math.max(0, len + i) : i) : 0; //支持逆向查找-从数组末尾
                    for(; i < len; i++){
                        if(i in array && array[i] === item) return i;
                    }
                }
            }
            return -1;
        },

        //阻止事件冒泡
        stopPropagation: function(e){
            e = e || window.event;
            if(e.stopPropagation){
                e.stopPropagation();
            }else{
                e.cancelBubble = true; //IE
            }
        },

        //扩展对象
        extend: function(){
            var target = arguments[0], n = 1, source;
            //如果只有一个参数则扩展lenote.helper自身
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

        //@e是否保留原值仅扩展, @o是否仅替换已有值, @d是否深扩展
        extend2: function(target, source, e, o, d){
            function assign(_this, prop){
                //if(d && _this.isObject(source[prop]) && (!target[prop] || _this.isObject(target[prop]))){
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

        //创建函数实例
        createInstance: function(o){
            /*jslint evil: true */
            var f = new Function();
            f.prototype = o;
            /*jslint supernew: true */
            o = new f;
            f.prototype = null;
            return o;
        },
        
        //对象继承
        inherits: function(subClass, superClass){
            var sub = subClass.prototype,
                _super = this.createInstance(superClass.prototype);
            this.extend(_super, sub);
            subClass.prototype = _super;
            return (_super.constructor = subClass);
        },

        //深度克隆对象
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

        //将json字符串转为json对象
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
        
        //将json对象转换成字符串
        stringify: function(data){
            return JSON.stringify(data);
        },

        //删除标签
        stripTags: function(content){
            //content = (content || '').replace(/<[^>]+>/igm, '').replace(/&nbsp;/igm, ' ').replace(/\r?\n/igm, '<br/>');
            //return content.replace(/<br\/?>|\s/ig, '') === ''? '' : content.replace(/\s/igm, '&nbsp;');
            content = (content || '').replace(/<[^>]+>/igm, '').replace(/\r?\n/igm, '<br/>');
            return content.replace(/<br\/?>|\s/ig, '') === ''? '' : content.trim();
        },
        
        //删除空白
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

        //判断元素是否包含指定的class
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
        
        //判断是否给定的标签
        isTagNode: function(node, name){
            //return new RegExp('^' + node.tagName + '$','i').test(name);
            return node.nodeType === 1 && new RegExp('^' + node.nodeName + '$', 'i').test(name);
        },
        
        //获取元素的位置
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

        //获取元素宽度
        getWidth: function(dom){
            var w = parseFloat(dom.style.width) || dom.width || dom.offsetWidth;
            if(w && w > 0) return w;
            return Math.max(dom.scrollWidth, dom.clientWidth, parseFloat(dom.style.width) || 0);
        },
        
        //获取元素高度
        getHeight: function(dom){
            var h = parseFloat(dom.style.height) || dom.height || dom.offsetHeight;
            if(h > 0) return h;
            return Math.max(dom.scrollHeight, dom.clientHeight, parseFloat(dom.style.height) || 0);
        },

        //滑动到指定位置
        slideTo: function(target, speed){
            //var pos = target.offsetTop - 5, current_pos = document.body.scrollTop, distance = pos - current_pos, duration = Math.abs(distance) / speed;
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

        //获取中文的数字
        getCHNumber: function(v, addUnit){
            function convert(n){
                if(addUnit && n === 0) return '零';
                return n? n.replace(/\d/g, function(m){
                    return {
                        0: 'O', 1: '一', 2: '二', 3: '三', 4: '四',
                        5: '五', 6: '六', 7: '七', 8: '八', 9: '九', 10: '十'
                    }[m];
                }) : '';
            }
            v = parseInt(v) + '';
            if(addUnit){
                var unit = ['', '十', '百', '千', '万', '十万', '百万', '千万', '亿'], len = v.length, result = '';
                for(var i = 0; i < len; i++){
                   if(v[i] === 0 && v > 100 && len -1 !== i){
                        result += convert(v[i]);
                   }else if(v[i] !== 0){
                        result += convert(v[i]) + unit[len - i - 1];
                   }
                }
                return result.replace(/^一十(.*?)$/, '十$1');
            }else{
                return convert(v);
            }
        },

        scrollTo: function(sel){
            //$('body').scrollTo(sel);
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
          // var ua = navigator.userAgent.toLowerCase();
          // if(ua.match(/MicroMessenger/i) == 'micromessenger'){
          //   return true;
          // }else{
          //   return false;
          // }
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

        //判断功能键(未包含Mac键盘上的功能键、大写键、win键、打印翻页键、小键盘开关键等)，排除: 退格8、回车13、Delete46
        isFunctionKey: function(keyCode){
           switch(keyCode){
               case 9: //Tab
               case 16: case 17: case 18: //Shift、Ctrl、Alt
               case 20: case 27: //大小写切换、esc
               case 37: case 38: case 39: case 40: //左上右下
               case 33: case 34: case 35: case 36: case 45: //PageUp、PageDown、End、Home、Insert
               case 44: case 145: case 19: case 144: //PrintSc、Scroll Lock、Pause Break、NumLock
               case 91: case 92: //左右win键
                  return true; break;
               default:
                  if(keyCode >= 112 && keyCode <= 123) return true; //F1-F12
                  return false;
           }
        },

        getID: function(data, prefix, type){
            prefix = prefix || '';
            type = type || 'marker';
            var str = '';
            switch(type){
                case 'marker': //data => marker
                    var lnglat = data.getPosition();
                    str = lnglat.getLng() + ',' + lnglat.getLat();
                    break;
                case 'lnglat':
                    str = data.lng + ',' + data.lat;
                    break;
                default: //data = {#1: marker2, #2: marker2}
                    var _tmp = [];
                    for(var k in data){
                        var lnglat = data[k].getPosition();
                        _tmp.push(lnglat.lng + ',' + lnglat.lat);
                    }
                    str = _tmp.join(';');
            }
            return prefix + md5(str);
        },

        getHashcode: function(data){
            var str = '';
            for(var i in data){
                str += data[i].lng + '' + data[i].lat;
            }
            return md5(str);
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
          datetime = datetime.replace(/-/g, '/');
          // var date = (datetime)?new Date(datetime):new Date(),
          var date = new Date(datetime) == 'Invalid Date'? new Date : new Date(datetime),
              tday = (new Date).getDate() - date.getDate(),
              from = Math.round(date.getTime() / 1000),
              now = Math.round((new Date).getTime() / 1000),
              time = now - from;
          if(tday == 0){
              if(time > 3600){
                  return Math.floor(time / 3600) + '小时前';
              }else if(time > 60){
                  return Math.floor(time / 60) + '分钟前';
              }else if(time > 0){
                  return time + '秒前';
              }else{
                  return '刚刚';
              }
          }else{
              var ftime = date.Format("MM月dd日 hh:mm"),
                  _now = new Date;
              date.setHours(0);date.setMinutes(0);date.setSeconds(0);date.setMilliseconds(0);
              _now.setHours(0);_now.setMinutes(0);_now.setSeconds(0);_now.setMilliseconds(0);
              var _time = Math.round((_now.getTime() - date.getTime()) / 1000);
                  dday = Math.ceil(_time / 86400);
              if(dday > 0 && dday < 7){
                if(dday <= 2){
                    return dday == 1? '昨天' : '前天';
                }else{
                    return dday + '天前';
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
            //_prompt.popover({title:title, content:content}).popover('show');
            if(action == 'show'){
                //$(window).height()
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
                title = title || '保存成功';
                icon = icon || 'success';
                // _modal.attr('data-type', icon).find('.tip-form .hint').text(title);
                _modal.attr('data-type', icon).find('.tip-form .hint').html(title);
                timeout = timeout || 0;
                if(timeout > 0){
                    setTimeout(function(){
                        //隐藏时执行回调函数callback
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

        getPriceUnit: function(priceUnit){
            var unit = '人';
            switch(priceUnit){
                case 1: unit = '人';break;
                case 2: unit = '家庭';break;
                case 3: unit = '组';break;
            }
            return unit;
        },

        caches: {},
        doing: {},
        asynRequest: function(url, data, callback, useCache, notMultiple, key){
            notMultiple = notMultiple === false? false : true;
            callback = callback || {};
            key = key || url;
            if(this.doing[key] === true && notMultiple) return;
            
            //调用回调函数中的初始化函数
            if(typeof callback.init == 'function'){
                callback.init();
            }

            //缓存处理
            if(useCache && this.caches[url]){
                return this.caches[url];
            }else if(this.caches[url]){
                delete this.caches[url];
            }

            this.doing[key] = true;

            //通过data参数临时解决jquery ajax参数的问题
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
                      CHelper.prompt('show', null, '处理中...');
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
                                CHelper.prompt('show', null, '处理成功');
                            }
                        }else{
                            if(typeof callback.failure == 'function'){
                                callback.failure(response);
                            }else{
                                if(response.code == 401){
                                    // CHelper.prompt('show', null, '请先登录');
                                    CHelper.toggleTip('show', '请先登录', 'warn', 800);
                                }else if(response.code == 403){
                                    // CHelper.prompt('show', null, '请求无权限');
                                    CHelper.toggleTip('show', '请求无权限', 'warn', 800);
                                }else{
                                    // CHelper.prompt('show', null, '状态码错误');
                                    CHelper.toggleTip('show', '状态码错误', 'warn', 800);
                                }
                            }
                        }
                    }else{
                        if(typeof callback.refuse == 'function'){
                            callback.refuse(response);
                        }else{
                            CHelper.prompt('show', null, '数据异常');
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
                      CHelper.prompt('show', null, '内部错误');
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
    template.helper('getPriceUnit', CHelper.getPriceUnit);
    template.helper('getQiniuDomain', CHelper.getQiniuDomain);
})(window);