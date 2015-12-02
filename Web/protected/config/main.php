<?php
return array(
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name' => 'naked',
	'language' => 'en_us',
	'sourceLanguage' => 'en_us',
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.components.widget.*',
		'application.proxy.*',
	),
	'components' => array(
		'urlManager' => require(dirname(__FILE__).'/route.php'),
		'db' => array(
			'connectionString' => 'mysql:host=localhost:3306;dbname=naked',
			'username' => 'root',
			'password' => 'Email@2015',
			'charset' => 'utf8',
			'emulatePrepare' => true,
		),
		'user' => array(
			// 'class' => 'CWebUser',
			'class' => 'WebUser',
			// enable cookie-based authentication
			'allowAutoLogin' => true,
			//'loginUrl' => '/login.html',
			'loginUrl' => array('user/login'),
			//'loginRequiredAjaxResponse' => '请先登录',
			'loginRequiredAjaxResponse' => '{"code": 401, "msg": "请登录"}',
		),
	),
);