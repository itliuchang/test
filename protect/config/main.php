<?php
Yii::setPathOfAlias('/', dirname(__FILE__) . '/../../public/');
return array(
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name' => 'naked',
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.components.widget.*',
		'application.proxy.*',
	),
	'components' => array(
		'urlManager' => require(dirname(__FILE__).'/route.php'),
		'db' => array(
			'connectionString' => 'mysql:host=120.55.160.183:3306;dbname=naked',
			'username' => 'root',
			'password' => 'Email@2015',
			'charset' => 'utf8',
			'emulatePrepare' => true,
		)
	),
);