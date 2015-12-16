<?php
Yii::setPathOfAlias('lib', dirname(__FILE__) . '/../library');

return array(
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name' => 'naked',
	
	'preload'=>array('log'),

	'language' => 'en_us',
	'sourceLanguage' => 'en_us',

	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.components.widget.*',
		'ext.helper.*',
		'ext.foundation.*'
	),

	'components' => array(
		'request' => array(
			'class' => 'application.components.HttpRequest',
			'enableCsrfValidation' => true,
			'noCsrfValidationRoutes' => array(
				'payment/wxpay/notify',
			),
			'enableCookieValidation' => true,
		),

		'curl' => array(
			'class' => 'ext.curl.Curl',
			'options' => array(
		        CURLOPT_CONNECTTIMEOUT => 10,
		        CURLOPT_TIMEOUT        => 10,
				CURLOPT_VERBOSE => false
			)
		),

		'mdetect' => array(
			'class' => 'ext.mdetect.MobileDetect'
		),

		'user' => array(
			// 'class' => 'CWebUser',
			'class' => 'WebUser',
			// enable cookie-based authentication
			'allowAutoLogin' => true,
			'loginUrl' => array('user/login'),
			'loginRequiredAjaxResponse' => '{"code": 401, "msg": "please login"}',
		),

		'urlManager' => require(dirname(__FILE__).'/route.php'),

		'db' => array(
			'connectionString' => 'mysql:host=localhost;dbname=naked',
			'username' => 'root',
			'password' => 'Email@2015',
			'charset' => 'utf8',
			'emulatePrepare' => true,
		),

		'session' => array(
			'class' => 'system.web.CDbHttpSession',
			'connectionID' => 'db',
			'sessionTableName' => 'session',
			'timeout' => 86400,
		),

		'errorHandler'=>array(
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
					//'levels'=>'trace, info, debug, warn, error, fatal, profile',
					//'categories'=>'test.*',
					//'maxFileSize'=>1048576,
					//'logFile'=>'test.log',
				),
				// uncomment the following to show log messages on web pages
				// array(
				// 	'class'=>'CWebLogRoute',
				// 	//'categories' => 'test.*',
				// 	//'levels' => CLogger::LEVEL_PROFILE,
				// 	//'showInFireBug' => true,
				// 	//'ignoreAjaxInFireBug' => true,
				// ),
			),
		),
	),

	'params' => require(dirname(__FILE__).'/params.php'),
);