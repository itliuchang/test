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
    checkNewMessage();
    setInterval(checkNewMessage, 60 * 1000);
});