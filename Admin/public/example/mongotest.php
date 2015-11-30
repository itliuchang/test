<?php
date_default_timezone_set("Asia/Shanghai");
ini_set("display_errors", "on");
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);

//http://www.tuicool.com/articles/my6nAv
define('ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('CLASS_PATH', ROOT . 'classes/');

//echo Yii::app()->mongodb->getConnection()->location->session->count();
//等同于echo Yii::app()->mongodb->getDB()->session->count();
//echo Yii::app()->mongodb->getDB()->selectCollection('session')->count();
//print_r(Yii::app()->mongodb->getDB()->session->findOne());die;
//print_r(iterator_to_array(Yii::app()->mongodb->getDB()->session->find()));die;
class Yii{
    public static function setPathOfAlias($alias, $path){}
}
$config = include_once(ROOT . '../config/main.php');
// $mongo = new Mongo("{$config['components']['mongodb']['server']}");
// $db = $mongo->selectDB($config['components']['mongodb']['db']);
// print_r(iterator_to_array($db->site->find()));die;
// print_r($db->site->count());die;
// print_r($db->site->findOne());die;
// $coll = $db->selectCollection('place');
// print_r($coll->count());die;
$mgconfig = $config['components']['mongodb'];
$mongo = new Mongo("{$mgconfig['server']}/{$mgconfig['db']}");
$coll = $mongo->{$mgconfig['db']}->selectCollection('place');
// $result = $coll->insert(array("name" => "Joe1", "age" => 20), array('safe' => true));
// $result = $coll->insert(array("name" => "Joe1", "age" => 20));
// 1.
// $b = array("name" => "Joe1", "age" => 20);
// $ref = &$b;
// $result = $coll->insert($ref);
// print_r($b);print_r($ref);die;
// 2.
// $a = array("name" => "Joe1", "age" => 20);
// $result = $coll->insert($a);
// print_r($a['_id']->getHostname());die;
// print_r($a['_id']->__toString());die;
// print_r($a['_id'] . '');die;
// print_r($result);print_r($a['_id']);print_r($a);die;

// $json = json_decode(file_get_contents(ROOT . 'places.json'));
// print_r($json[1]->name);die;

// php mongo
// $mongo_id = new MongoID($id_string);
// $cursor = Place::model()->find(array('pid' => -1));
// while($cursor->hasNext()) $r = $cursor->getNext();
// foreach($cursor as $k=>$v) var_dump($r);
// $array= iterator_to_array($cursor);
// $array[0]->name, $array[0]->_id非$array[0]->$id

$json = json_decode(file_get_contents(ROOT . 'places.json'), true);

$mongo->close();