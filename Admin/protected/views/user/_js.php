$(function(){
    setTimeout(function(){
        $('#loginModal').modal({
            keyboard: false, show: true //backdrop: false,
        });
    }, 800);

    
    
    $('#loginModal').on('click', '.modal-footer .btn', function(e){
        e.stopPropagation();
        e.preventDefault();
        var modal = $(this).closest('.modal'),
            username = $.trim(modal.find('input.username').val()),
            password = $.trim(modal.find('input.password').val());
        if($.isEmptyObject(username)){
            CHelper.toggleTip('show', '请输入用户名', 'warn', 800);
            modal.find('input.username').focus();
        }else if($.isEmptyObject(password)){
            CHelper.toggleTip('show', '请输入密码', 'warn', 800);
            modal.find('input.password').focus();
        }else{
            CHelper.asynRequest('/login.html', {username: username, password: password}, {
                before: function(xhr){
                    CHelper.toggleTip('show', '登录中...', 'loading');
                },
                success: function(response){
                    CHelper.toggleTip('show', '登录成功', null, 800, function(){
                        // location.href = '/';
                        var targetUrl = response.returnurl || '/';
                        location.href = targetUrl;
                    });
                },
                successReturnAll: true,
                failure: function(response){
                    CHelper.toggleTip('show', '用户名或密码错误！', 'error', 800);
                },
                refuse: function(response){
                    CHelper.toggleTip('show', '应用错误，请稍后重试！', 'error', 800);
                },
                complete: function(status){},
                error: function(msg){
                    CHelper.toggleTip('show', '登录失败，请重新登录！', 'error', 800);
                }
            });
        }
    });
});