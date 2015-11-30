(function($){
    //jQuery对象扩展
    $.fn.extend({
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
                url: null
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
                            // url = helper.sprintf(options.url, pageNum, options.perPage);
                            url = sprintf(options.url, {page: pageNum, size: options.perPage});

                        helper.asynRequest(url, null, {
                            before: function(xhr){
                                if(typeof options.callbacks.before == 'function'){
                                    options.callbacks.before(xhr);
                                }else{
                                    // helper.toggleTip('show', '正在加载', 'loading');
                                }
                            },
                            error: function(msg){
                                if(typeof options.callbacks.error == 'function'){
                                    options.callbacks.error(msg);
                                }else{
                                    // helper.toggleTip('show', msg, 'error');
                                }
                            },
                            complete: function(xhr, status){
                                if(typeof options.callbacks.complete == 'function'){
                                    options.callbacks.complete(xhr, status);
                                }else{
                                    // helper.toggleTip('hide');
                                }
                            },
                            refuse: function(response){
                                if(typeof options.callbacks.refuse == 'function'){
                                    options.callbacks.refuse(response);
                                }else{
                                    // helper.toggleTip('show', '状态码错误: ' + response.code, 'warn', 1200);
                                }
                            },
                            failure: function(response){
                                if(typeof options.callbacks.failure == 'function'){
                                    options.callbacks.failure(response);
                                }else{
                                    // helper.toggleTip('show', '请求失败', 'error', 1200);
                                }
                            },
                            success: function(response){
                                if(!response.data || response.data.length < options.perPage){
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
        }
    });
})(jQuery);