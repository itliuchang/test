$(function(){
    //检查是否有新消息
    setInterval(function(){
        if(!window.systemVar.isGuest && window.systemVar.controller != 'message'){}
    }, 60 * 60);
});