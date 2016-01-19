<?php
return array(
    'urlFormat' => 'path',
    'caseSensitive' => false,
    'showScriptName' => false,
    'urlSuffix' => '.html',
    'rules' => array(
        'login' => 'user/login',
        'logout' => 'user/logout',
        'wechat/login' => 'wechat/wechatconnect',
        'wechat/login/callback' =>'wechat/wechatconnectcallback',
        'wechat/quiet/login' => 'wechat/wechatQuietConnect',
        'wechat/quiet/login/callback' =>'wechat/wechatQuietConnectCallback',
        
        'book/roomshow-<id:\d+>/<date:\w\S+>' => 'book/roomshow',
        // 'book/roomshow-<id:\d+>/<date:\w\S+>' => 'book/roomshow',
        'book/roomshow-<id:\d+>' => 'book/roomshow',
        'book/workspaceconfirm-<id:\d+>/<date:\w\S+>' => 'book/workspaceconfirm',
        'book/roomlist-<id:\d+>' => 'book/roomlist',

        'company/updateprofile-<id:\d+>' => 'company/updateprofile',
        'company/profile-<id:\d+>' => 'company/profile',
        'company/profile' => 'company/profile',
        'company/profile-<id:\d+>/<page:\d+>/<size:\d+>' => 'company/profile',
        'user/profile-<id:\d+>' => 'user/profile',
        'user/profile' => 'user/profile',
        'user/profile-<id:\d+>/<page:\d+>/<size:\d>' => 'user/profile',
        'user/like-<id:\d+>' => 'user/like',
        'user/liked-<id:\d+>' => 'user/liked',
        'payment/wxpay/jsapi/' => 'order/',
        'payment/wxpay/jsapi/company' => 'order/company',
        'payment/wxpay/notify' => 'order/notify',
        'registered/basicinfo' => 'registered/basicinfo',
        'registered/' => 'wechat/index',
        'code-<code:\w+>' => 'registered/codeaccess',
        'codeauth-<code:\w+>' => 'user/codeauth',

        'community/servicescompany-<id:\d+>' => 'community/servicescompany',

        'post/newlist/<page:\d+>/<size:\d+>' => 'post/newlist',
        'post/postshow-<id:\d+>' => 'post/postshow', 

        'message(/<page:\d+>(/<size:\d+>)?)?' => 'message',
        'message/<fid:\d+>/chat(/<start:\d+>(/<size:\d+>)?)?' => 'message/show',
        'message/friend/<fid:\d+>/add' => 'message/addfriend',
        'message/<fid:\d+>/send' => 'message/sendmsg',

        '<controller:\w+>/<id:\d+>'=>'<controller>/view',
        '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
        '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
    ),
);