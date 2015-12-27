$(function(){
    //检查是否有新消息
    setInterval(function(){
        var fbarM = $('.fbar-message');
        if(!systemVar.isGuest && fbarM.length == 1 && !fbarM.find('i.message').hasClass('dot') && systemVar.controller != 'message'){
            CHelper.asynRequest('/message/hasnew.html', null, {
                before: function(xhr){},
                success: function(data){
                    if(data == true) $('.fbar-message .message').addClass('dot');
                },
                error: function(msg){},
                failure: function(response){},
                refuse: function(response){},
                complete: function(status){}
            });
        }
    }, 60 * 1000);
});