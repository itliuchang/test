<?php
return array(
    'urlFormat' => 'path',
    'caseSensitive' => false,
    'showScriptName' => false,
    'urlSuffix' => '.html',
    'rules' => array(
        'login' => 'user/login',
        'logout' => 'user/logout',
        'wechat/login' => 'wechat/wechatConnect',
        'wechat/login/callback' =>'wechat/wechatConnectCallback',
        'wechat/quiet/login' => 'user/wechatQuietConnect',
        'wechat/quiet/login/callback' =>'user/wechatQuietConnectCallback',
        
        'book/roomshow-<id:\d+>' => 'book/roomshow',
        'book/workspaceconfirm-<id:\d+>/<date:\w\S+>' => 'book/workspaceconfirm',
        'company/updateprofile-<id:\d+>' => 'company/updateprofile',
        'company/profile-<id:\d+>' => 'company/profile',
        'company/profile' => 'company/profile',
        'user/profile-<id:\d+>' => 'user/profile',
        'user/profile' => 'user/profile',
        'payment/wxpay/jsapi/' => 'order/',
        'payment/wxpay/notify' => 'order/notify',
        'registered/basicinfo' => 'registered/basicinfo',

        'community/servicescompany-<id:\d+>' => 'community/servicescompany',


        'messages(/<page:\d+>(/<size:\d+>)?)?' => 'message',
        'message/<fid:\w+>/chat(/<start:\d+>(/<size:\d+>)?)?' => 'message/show',
        'message/friend/<fid:\w+>/add' => 'message/addfriend',
        'message/<fid:\w+>/send' => 'message/sendmsg',

        '<controller:\w+>/<id:\d+>'=>'<controller>/view',
        '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
        '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
    ),
);