<?php
return array(
    'adminEmail' => 'admin@naked.com',
    'partner' => array(
        'wechat' => array(
            'appid' => 'wx9e34096f71f89c2d',
            'appsecret' => '00d26d3784f5938698b44465abb57c1e',
            'oauth2' => array(
                'callback' => '/wechat/login/callback',
                'callback-quiet' => '/wechat/quiet/login/callback',
                'scope' => array('snsapi_base', 'snsapi_userinfo'),
                'authorize' => 'https://open.weixin.qq.com/connect/oauth2/authorize?',
                'token' => 'https://api.weixin.qq.com/sns/oauth2/access_token', //网页授权token
                'userinfo' => 'https://api.weixin.qq.com/sns/userinfo',
            ),
            'connect' => array(
                'token' => 'https://api.weixin.qq.com/cgi-bin/token',
                'userinfo' => 'https://api.weixin.qq.com/cgi-bin/user/info',
                'ticket' => 'https://api.weixin.qq.com/cgi-bin/ticket/getticket',
            ),
            'payment' => array( //微信商户配置见WxPay.Config.php
                'notify' => '/payment/wxpay/notify',
            ),
        ),
        'emchat' => array(
            'appkey' => 'naked#hubapp',
            'org' => array('name' => 'naked'),
            'app' => array(
                'name' => 'hubapp',
                'client_id' => 'YXA6BcP2sJ2IEeWr4cFwgvdI7Q',
                'client_secret' => 'YXA6Ibw6ZXt7J_7UeEc9rIm-kXXn96o'
            ),
            'sysAccount' => array( //默认发送通知或消息的系统帐号
                'name' => 'hubappAdmin',
                'password' => 'hubappAdmin!@#',
                'nickname' => 'System notification',
                'icon' => '/images/sysnotify.png'
            )
        ),
    	'sms' => array(
    		'send_url' => 'http://115.29.170.211:8085/sms.aspx',
    		'userid' => '2833',
    		'account' => '101608601',
    		'password' => 'shyb8899',
    		'action' => 'send',
    		'login_tpl' => '验证码为%d，您现在正在进行裸心社手机登录［裸心社］',
    		'regist_tpl' => '验证码为%d，您现在正在进行裸心社手机注册［裸心社］',
    	),
         //阿里云OSS配置
        'oss' => array(
            'bucket' => 'naked',
            'domain' => 'http://naked.oss-cn-shanghai.aliyuncs.com',
            'id' => '4BdbMZOR4c67xntc',
            'key' => 'tdKA6T1JCKaQcB6yFBw33SJo9tNGxw',
            'host' => 'http://oss.aliyuncs.com'
        ),
    )
);