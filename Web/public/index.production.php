<?php

date_default_timezone_set("Asia/Shanghai");

$yii = dirname(__FILE__) . '/../protected/library/framework/yii.php';
$config = dirname(__FILE__).'/../protected/config/main.production.php';

defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 0);
defined('YII_ENV') or define('YII_ENV', 'production');

require_once($yii);
Yii::createWebApplication($config)->run();