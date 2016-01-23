<?php
return array(
    'adminEmail' => 'admin@naked.com',
    'partner' => array(
        'wechat' => array(
            //naked 测试账号
            // 'appid' => 'wx05fa6a81aeab3873',
            // 'appsecret' => '8d5c9f76490e185aee2c4bf33b33f765',
            'appid' => 'wx81050376249cfc14',
            'appsecret' => '9a4f13a5a32d3c5939dacd3f977765ee',
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
                'nickName' => 'hubapp',
                'portrait' => '/images/sysnotify.png'
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
    	'submail' => array(
    		'url' => 'http://api.submail.cn/message/xsend.json',
    		'appid' => '10418',
    		'signature' => '1fa78b2448cac45ba9a345cc0b4c5c68',
    		'sign_type' => 'normal',
    		'login_project' => 'j4VDX2',
    		'regist_project' => 'd4HIa4'	
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