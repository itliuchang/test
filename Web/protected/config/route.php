<?php
return array(
    'urlFormat' => 'path',
    'caseSensitive' => false,
    'showScriptName' => false,
    'urlSuffix' => '.html',
    'rules' => array(
    	'login' => 'user/login',
        
        '<controller:\w+>/<id:\d+>'=>'<controller>/view',
        '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
        '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
    ),
);