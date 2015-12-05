<?php

return array(
    'adminEmail' => 'admin@naked.com',
    'partner' => array(
        'wechat' => array(
            'appid' => 'wx7bb14f41743c6da0',
            'appsecret' => '8b29a3940c907940d9b122d2524e6ece',
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
        )
    )
);