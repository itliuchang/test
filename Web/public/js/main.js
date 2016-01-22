$(function(){
    //检查是否有新消息
    function checkNewMessage(){
        var fbarM = $('.fbar-message');
        if(!systemVar.isGuest && fbarM.length == 1 && !fbarM.find('i.message').hasClass('dot') && systemVar.controller != 'message'){
            CHelper.asynRequest('/message/hasnew.html', null, {
                before: function(xhr){},
                success: function(data){
                    if(data == true){
                        $('.fbar-message .message').addClass('dot');
                    }else{
                        $('.fbar-message .message').removeClass('dot');
                    }
                },
                error: function(msg){},
                failure: function(response){},
                refuse: function(response){},
                complete: function(status){}
            });
        }
    }
    // setTimeout(tapon, 10);
    // function tapon(){
        $('a:has(.home)').hammer().on('tap',function(){
        location.href = '/post/newlist';
        });
        $('a:has(.community)').hammer().on('tap',function(){
            location.href = '/community/serviceslist';
        });
        $('a:has(.message)').hammer().on('tap',function(){
            location.href = '/message/';
        });
        $('a:has(.more)').hammer().on('tap',function(){
            location.href = '/more/';
        });
    // }
    checkNewMessage();
    setInterval(checkNewMessage, 60 * 1000);
});