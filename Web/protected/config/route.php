<?php
return array(
    'urlFormat' => 'path',
    'caseSensitive' => false,
    'showScriptName' => false,
    'urlSuffix' => '.html',
    'rules' => array(
        'messages' => 'message',
        'login' => 'user/login',
        'logout' => 'user/logout',
        'wechat/login' => 'user/wechatConnect',
        'wechat/login/callback' =>'user/wechatConnectCallback',
        'wechat/quiet/login' => 'user/wechatQuietConnect',
        'wechat/quiet/login/callback' =>'user/wechatQuietConnectCallback',
        
        'book/roomshow-<id:\d+>' => 'book/roomshow',
        'book/workspaceconfirm-<id:\d+>/<date:\w\S+>' => 'book/workspaceconfirm',
        'payment/wxpay/jsapi/' => 'order/',
        'payment/wxpay/notify' => 'order/notify',
        'registered/basicinfo' => 'registered/basicinfo',

        '<controller:\w+>/<id:\d+>'=>'<controller>/view',
        '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
        '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
    ),
);