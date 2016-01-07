$.infinitRefresh({
    container: '#messageshow .wrapper', item: '.item',
    url: '/message/' + friendId + '/chat/%(start)s/%(size)s.html',
    perPage: 5, data: null, callbacks: {
        success: function(response){
            if(typeof response.data == 'object' && $.isArray(response.data.list)){
                var html = template('showTpl', {
                    data: response.data.list, uid: systemVar.uid,
                    user: response.data.user,
                    // myportrait: $('#messageshow .wrapper .item.my .imgWrapper img').attr('src') || ''
                    myportrait: myportrait
                });
                $('#messageshow .wrapper').prepend(html);
            }
        }
    }
});

$(function(){
    $('.header img').hammer().on('tap',function(){
        if($('.header a').attr('_id')!=0){
            location.href = '/user/profile-'+$('.header a').attr('_id');
        }
    });

    if(friendId != 0){
        var conn = new Easemob.im.Connection();
        conn.init({
            https: true,
            url: 'wss://im-api.easemob.com/ws/',
            onOpened: function(_conn){
                // console.info('成功登录', _conn);
                conn.setPresence();
                if(conn.isOpened()){
                    conn.heartBeat(conn);
                }
            },
            onTextMessage: function(message){
                // console.info('接收消息', message);
                var html = template('showTpl', {
                    data: [{senderID: friendId, ctime: (new Date).getTime(), body: message.data}],
                    uid: systemVar.uid,
                    user: {portrait: fportrait},
                    myportrait: myportrait
                });
                $('#messageshow .wrapper').append(html);
            },
            onEmotionMessage: function(message){
                console.info(message);
            },
            onPictureMessage: function(message){
                console.info(message);
            },
            onAudioMessage: function(message){
                console.info(message);
            },
            onLocationMessage: function(message){
                console.info(message);
            },
            onFileMessage: function(message){
                console.info(message);
            },
            onVideoMessage: function(message){
                console.info(message);
            },
            onPresence: function(message){
                console.info(message);
            },
            onRoster: function(message){
                console.info(message);
            },
            onInviteMessage: function(message){
                console.info(message);
            },
            onClosed: function(){
                conn.clear();
                conn.onClosed();
                conn = null;
            },
            onError: function(e){
                var msg = e.msg;
                if(e.type == EASEMOB_IM_CONNCTION_SERVER_CLOSE_ERROR){
                    if(msg == '' || msg == 'unknown' ){
                        CHelper.toggleTip('show', '服务器断开连接或在别处登录', 'warn', 800);
                    }else{
                        CHelper.toggleTip('show', '服务器断开连接', 'warn', 800);
                    }
                }else if(e.type === EASEMOB_IM_CONNCTION_SERVER_ERROR){
                    if(msg.toLowerCase().indexOf('user removed') != -1){
                        CHelper.toggleTip('show', '用户已经在管理后台删除', 'warn', 800);
                    }
                }else{
                    // console.info(e)
                    CHelper.toggleTip('show', msg, 'error', 800);
                }
                conn.stopHeartBeat(conn);
                conn = null;
            }
        });
        conn.open({apiUrl: '', appKey: appkeyIm, user: '' + systemVar.uid, pwd: 'nakedim'});
        $(window).on('beforeunload unload', function(){
            if(conn){
                conn.close();
                // return navigator.userAgent.indexOf('Firefox') > 0? ' ' : '';
            }
        });
    }

    $('.footer .sendbtn').hammer().on('tap', function(e){
        e.gesture.srcEvent.preventDefault();
        var _this = $(this);
        if(_this.hasClass('disabled')) return;
        _this.addClass('disabled');
        var content = $.trim($('.footer textarea').val());
        if(!content){
            CHelper.toggleTip('show', '消息是空的', 'warn', 800);
        }else{
            // content = Easemob.im.Helper.parseTextMessage(content.replace(/\n/g, '<br>'));
            content = content.replace(/\n/g, '<br>');
            var html = template('showTpl', {
                data: [{senderID: systemVar.uid, ctime: (new Date).getTime(), body: content}],
                uid: systemVar.uid,
                user: {portrait: myportrait},
                myportrait: myportrait
            });
            $('#messageshow .wrapper').append(html);

            CHelper.asynRequest('/message/' + friendId + '/send.html', {
                content: content,
                parameter: {type: 'POST'}
            }, {
                before: function(xhr){},
                success: function(data){
                    $('.footer textarea').val('');
                },
                error: function(msg){},
                failure: function(response){},
                refuse: function(response){},
                complete: function(status){
                    $('.footer .sendbtn').removeClass('disabled');
                }
            });

            /*if(conn) conn.sendTextMessage({to: friendId, msg: content, type: 'chat'});*/
        }
    });
});