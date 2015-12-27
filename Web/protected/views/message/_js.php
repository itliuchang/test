$.infinitScroll({
    container: '#messagelist', item: '.option',
    url: '/message/%(page)s/%(size)s.html',
    perPage: 15, data: null, callbacks: {
        success: function(response){
            if(typeof response.data == 'object' && $.isArray(response.data.list)){
                // var html = template('indexTpl', {data: response.data.list});
                // $('#newest > ul').append(html);
                console.info(response)
            }
        }
    }
});