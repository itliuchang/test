(function($){
    //jQuery对象扩展
    $.fn.extend({
        clockCountdown: function(options){
            var defaults = {
                d: '.day', h: '.hour', m: '.minute', s: '.second'
            };
            options = $.extend(defaults, options || {});
            return this.each(function(){
                var _this = $(this),
                    list = {
                        d: _this.find(options.d), h: _this.find(options.h),
                        m: _this.find(options.m), s: _this.find(options.s)
                    },
                    interval = setInterval(function(){
                        var sec = parseInt(list.s.text());
                        if(isNaN(sec) || sec <= 0){
                            list.s.text(0);
                            clearInterval(interval);
                        }else{
                            sec -= 1;
                            if(sec == 0){
                                var min = parseInt(list.m.text()) || 0,
                                    hour = parseInt(list.h.text()) || 0,
                                    day = parseInt(list.d.text()) || 0;

                                if(min > 0){
                                    min -= 1, sec = 59;
                                }else if(hour > 0){
                                    hour -= 1, min = 59, sec = 59;
                                }else if(day > 0){
                                    day -= 1, hour = 23, min = 59, sec = 59;
                                }

                                if(sec < 10 && sec > 0) sec = '0' + sec;
                                if(min < 10 && min > 0) min = '0' + min;
                                if(hour < 10 && hour > 0) hour = '0' + hour;
                                if(day < 10 && day > 0) day = '0' + day;
                                list.s.text(sec);list.m.text(min);
                                list.h.text(hour);list.d.text(day);
                            }else{
                                if(sec < 10) sec = '0' + sec;
                                list.s.text(sec);
                            }
                        }
                    }, 1000);
            });
        },

        quickBar:function(options){
            var that = $(this);
            if(typeof options == 'string') options = {action: options};
             var defaults = {
                action : 'show',
             }

             options = $.extend(defaults, options || {});
             if(options.action == 'show'){
                $('body').append('<div class="quickBarbg"></div>');
                that.addClass('up');
                setTimeout(function(){
                    $('.quickBarbg').addClass('in');
                     $('.quickBarbg, .quickBar .cancel').hammer().on('tap', function(e){
                        e.gesture.srcEvent.preventDefault();
                        $('.quickBar').quickBar('hide');
                     });
                }, 50);
             }else{
                $('div').remove('.quickBarbg');
                that.removeClass('up');
             }
        },

        mockScrollY: function(options){
            var defaults = {
                wrap: '',
                content: 'ul',
                distance: 100 //鼠标滚动滚轮单次移动的距离
            };
            options = $.extend(defaults, options || {});

            // var wrapObj = $(options.wrap),
            //     contentObj = wrapObj.find(options.content);

            function fnChangePos(data, wrapObj, contentObj){
                var $wh = wrapObj.height(),
                    $ch = contentObj.height(),
                    $sh = 0;
                if(data < 0){
                    data = 0;
                }else if(data > ($ch - $wh - $sh)){
                    data = $ch - $wh - $sh;
                }
                wrapObj.scrollTop(data);
            }

            //鼠标滚轮事件处理函数
            // function fnMouseWheel(event){
            function fnMouseWheel(e, wrapObj, contentObj){
                // event.stopPropagation();
                // event.preventDefault();
                // var e = event || window.event,
                //     evt = e.originalEvent;
                //鼠标滚动值，可由此判断鼠标滚动方向
                //也可使用evt.wheelDeltaY代替，也可使用evt.deltaY代替distance滚动的距离
                var evt = e.originalEvent,
                    wheelDelta = evt.wheelDelta || evt.detail;
                if(wheelDelta == -120 || wheelDelta == 3){ //$(options.wrap).position().top
                    fnChangePos(wrapObj.scrollTop() + options.distance, wrapObj, contentObj);
                }else if (wheelDelta == 120 || wheelDelta == -3){
                    fnChangePos(wrapObj.scrollTop() - options.distance, wrapObj, contentObj);
                }
            }

            return this.each(function(){
                var _this = $(this);
                //滚动条鼠标滚轮事件注册
                // if(_this.get(0).addEventListener){ //for firefox
                //     _this.get(0).addEventListener("DOMMouseScroll", fnMouseWheel);
                // }else{
                //     _this.get(0).onmousewheel = fnMouseWheel;
                // }
                // 改进：动态监听事件，当元素dom变化也可以实时监听而不需要重新绑定
                // $('#overlaySetModal').mockScrollY({wrap: '.ddChild', content: 'ul'})
                // _this.off('mousewheel').on('mousewheel', fnMouseWheel);
                _this.off('mousewheel', options.wrap).on('mousewheel', options.wrap, function(event){
                    var event = event || window.event,
                        wrapObj = _this.find(options.wrap),
                        contentObj = wrapObj.find(options.content);
                    event.stopPropagation();
                    event.preventDefault();
                    fnMouseWheel(event, wrapObj, contentObj);
                });
            });
        }
    });

    //jQuery类扩展
    $.extend({
        infinitScroll: function(options){
            var defaults = {
                container: '.container',
                item: '.item',
                distance: 60,
                callbacks: {},
                perPage: 10,
                url: null,
                data:{},
            };
            options = $.extend({}, defaults, options || {});
            //私有函数
            function getScrollTop(){
                var pageHeight = Math.max(document.body.scrollHeight || document.body.offsetHeight),
                    viewportHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight || 0,
                    scrollHeight = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0; //$('body').scrollTop()
                // $('body').offset().top, $('body').position().top
                // $(window).scrollTop() + $(window).height() >= ($(document).height()*0.8)
                return pageHeight - viewportHeight - scrollHeight < options.distance;
            }
            var len = $(options.container + '>' + options.item).length;
            if(len >= options.perPage && !!options.url){
                $(window).scroll(function(){
                    if(getScrollTop()){
                        var len = $(options.container + '>' + options.item).length,
                            pageNum = Math.ceil(len / options.perPage) + 1,
                            // url = '/pk/' + pageNum + '/' + options.perPage + '.html';
                            // url = CHelper.sprintf(options.url, pageNum, options.perPage);
                            url = sprintf(options.url, {page: pageNum, size: options.perPage});

                        CHelper.asynRequest(url, {parameter: {type: 'GET', data: options.data}}, {
                            before: function(xhr){
                                if(typeof options.callbacks.before == 'function'){
                                    options.callbacks.before(xhr);
                                }else{
                                    // CHelper.toggleTip('show', '正在加载', 'loading',1000);
                                }
                            },
                            error: function(msg){
                                if(typeof options.callbacks.error == 'function'){
                                    options.callbacks.error(msg);
                                }else{
                                    CHelper.toggleTip('show', msg, 'error');
                                }
                            },
                            complete: function(xhr, status){
                                if(typeof options.callbacks.complete == 'function'){
                                    options.callbacks.complete(xhr, status);
                                }else{
                                    // CHelper.toggleTip('hide');
                                }
                            },
                            refuse: function(response){
                                if(typeof options.callbacks.refuse == 'function'){
                                    options.callbacks.refuse(response);
                                }else{
                                    CHelper.toggleTip('show', '状态码错误: ' + response.code, 'warn', 1200);
                                }
                            },
                            failure: function(response){
                                if(typeof options.callbacks.failure == 'function'){
                                    options.callbacks.failure(response);
                                }else{
                                    CHelper.toggleTip('show', '请求失败', 'error', 1200);
                                }
                            },
                            success: function(response){
                                // if(!response.data || response.data.length < options.perPage || response.data.list.length < options.perPage){
                                    // CHelper.toggleTip('show',JSON.stringify(response),'success');
                                var list = response.data.list || response.data.result; 
                                if(!response.data || list.length < options.perPage){
                                    $(window).off('scroll');
                                }
                                if(typeof options.callbacks.success == 'function'){
                                    options.callbacks.success(response);
                                }
                            },
                            successReturnAll: true
                        });
                    }
                });
            }
        },
       
    });
})(jQuery);