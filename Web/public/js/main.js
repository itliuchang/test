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
    setInterval(function(){
        $('a .home').hammer().on('tap',function(){
        location.href = '/post/newlist';
        });
        $('a .community').hammer().on('tap',function(){
            location.href = '/community/serviceslist';
        });
        $('a .message').hammer().on('tap',function(){
            location.href = '/message/';
        });
        $('a .more').hammer().on('tap',function(){
            location.href = '/more/';
        });
    }(), 10);
    
    checkNewMessage();
    setInterval(checkNewMessage, 60 * 1000);
});