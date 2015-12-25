$(function(){
    //检查是否有新消息
    setInterval(function(){
        var fbarM = $('.fbar-message');
        if(!systemVar.isGuest && fbarM.length == 1 && !fbarM.hasClass('hasnew') && systemVar.controller != 'message'){
            CHelper.asynRequest('/message/hasnew.html' + pid + '/create.html', null, {
                before: function(xhr){},
                success: function(data){
                    if(data == true) $('.fbar-message').addClass('hasnew');
                },
                error: function(msg){},
                failure: function(response){},
                refuse: function(response){},
                complete: function(status){}
            });
        }
    }, 60 * 1000);
});