$.infinitRefresh({
    container: '#messageshow .wrapper', item: '.item',
    url: '/message/' + friendId + '/chat/%(start)s/%(size)s.html',
    perPage: 15, data: null, callbacks: {
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