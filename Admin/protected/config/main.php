<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// Yii::getPathOfAlias('local');
Yii::setPathOfAlias('lib', dirname(__FILE__) . '/../library');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'LBSManager',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.helper.*',
		'application.proxy.*',
		'application.extensions.baidu.*',
		'application.extensions.foundations.*',
		'application.extensions.oss_php_sdk.*'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
	),

	// application components
	'components'=>array(
		'request' => array(
			//'enableCsrfValidation' => true,
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

		'user' => array(
			// 'class' => 'CWebUser',
			'class' => 'WebUser',
			// enable cookie-based authentication
			'allowAutoLogin' => true,
			//'loginUrl' => '/login.html',
			'loginUrl' => array('user/login'),
			//'loginRequiredAjaxResponse' => '请先登录',
			'loginRequiredAjaxResponse' => '{"code": 401, "msg": "请先登录"}',
		),

		// uncomment the following to enable URLs in path-format
		'urlManager' => require(dirname(__FILE__).'/route.php'),

		// database settings are configured in database.php
		// 'db'=>require(dirname(__FILE__).'/database.php'),
		'db' => array(
			// 'class' => 'CDbConnection',
			// 'driverName' => 'mysql',
			// 'connectionString' => 'mysql:host=192.168.1.103:3306;dbname=sgs',
			// 'username' => 'sgs',
			// 'password' => 'sgs2015',
			'connectionString' => 'mysql:host=120.55.160.183:3306;dbname=naked',
			'username' => 'root',
			'password' => 'Email@2015',
			'charset' => 'utf8',
			'emulatePrepare' => true,
			'tablePrefix' => 'naked_',
		),


		'session' => array(
			//'autoStart' => true,
			
			
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		//Yii::log($e->getMessage(),CLogger::LEVEL_ERROR,'exception.CCouchBaseException');
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
					//'levels'=>'trace, info, debug, warn, error, fatal, profile',
					//'categories'=>'test.*',
					//'maxFileSize'=>1048576,//单文件最大1G
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

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => require(dirname(__FILE__).'/params.php'),
);
