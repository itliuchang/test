(function($){
    $.fn.extend({
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
                distance: 100
            };
            options = $.extend(defaults, options || {});

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

            function fnMouseWheel(e, wrapObj, contentObj){
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

    $.extend({
        infinitRefresh: function(options){
            var defaults = {
                container: '.container',
                item: '.item',
                distance: 0,
                callbacks: {},
                perPage: 10,
                url: null,
                data:{},
                delay: 800
            };
            options = $.extend({}, defaults, options || {});

            function sendAjax(){
                var start = $(options.container + '>' + options.item).length,
                    url = sprintf(options.url, {start: start, size: options.perPage});
                CHelper.asynRequest(url, {parameter: {type: 'GET', data: options.data}}, {
                    before: function(xhr){
                        if(typeof options.callbacks.before == 'function'){
                            options.callbacks.before(xhr);
                        }else{
                            // CHelper.toggleTip('show', 'loading', 'loading',1000);
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
                            CHelper.toggleTip('show', 'status error: ' + response.code, 'warn', 1200);
                        }
                    },
                    failure: function(response){
                        if(typeof options.callbacks.failure == 'function'){
                            options.callbacks.failure(response);
                        }else{
                            CHelper.toggleTip('show', 'request failure', 'error', 1200);
                        }
                    },
                    success: function(response){
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

            var len = $(options.container + '>' + options.item).length;
            if(len >= options.perPage && !!options.url){
                $(window).scroll(function(){
                    if($(document).scrollTop() <= options.distance){
                       setTimeout(function(){
                         if($(document).scrollTop() <= options.distance){
                            sendAjax();
                         }
                       }, options.delay);
                    }
                });
            }
        },

        infinitScroll: function(options){
            var defaults = {
                container: '.container',
                item: '.item',
                distance: 60,
                callbacks: {},
                perPage: 10,
                url: null,
                data:{}
            };
            options = $.extend({}, defaults, options || {});
            
            function getScrollTop(){
                var pageHeight = Math.max(document.body.scrollHeight || document.body.offsetHeight),
                    viewportHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight || 0,
                    scrollHeight = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
                return pageHeight - viewportHeight - scrollHeight < options.distance;
            }
            var len = $(options.container + '>' + options.item).length;
            if(!!options.url){
                $(window).scroll(function(){
                    if(getScrollTop()||$(options.container).outerHeight()<100){
                        var len = $(options.container + '>' + options.item).length,
                            pageNum = Math.ceil(len / options.perPage) + 1,
                            url = sprintf(options.url, {page: pageNum, size: options.perPage});
                        CHelper.asynRequest(url, {parameter: {type: 'GET', data: options.data}}, {
                            before: function(xhr){
                                if(typeof options.callbacks.before == 'function'){
                                    options.callbacks.before(xhr);
                                }else{
                                    // CHelper.toggleTip('show', 'loading', 'loading',1000);
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
                                    CHelper.toggleTip('show', 'status error: ' + response.code, 'warn', 1200);
                                }
                            },
                            failure: function(response){
                                if(typeof options.callbacks.failure == 'function'){
                                    options.callbacks.failure(response);
                                }else{
                                    CHelper.toggleTip('show', 'request failure', 'error', 1200);
                                }
                            },
                            success: function(response){
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