<?php
date_default_timezone_set("Asia/Shanghai");
ini_set("display_errors", "on");
// error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
$config = dirname(__FILE__).'/../protected/config/main.php';
require_once(dirname(__FILE__).'/../protected/library/framework/yii.php');
Yii::createWebApplication($config)->run();
