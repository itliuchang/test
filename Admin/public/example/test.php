<?php
date_default_timezone_set("Asia/Shanghai");

// /usr/local/mongodb/bin/mongo -u xingzhe -p xingzhe2015 --port 26001 --host 192.168.1.102 location
// ./mongo localhost:26001/admin --username=xingzhe --password=xingzhe2015
// /usr/local/mongodb26/bin/mongo 127.0.0.1:10001/location -> db.auth(username, password)
// ./mongo --port 26001 --username=xingzhe --password=xingzhe2015 location

// mongo shell: use 'help' commmand:
//  use location; db.abc.remove({});删除所有文档db.abc.drop();删除集合db.dropDatabase();删除数据库
//  db.addUser(u,p);db.removeUser(u);db.abc.find();
// echo extension_loaded('mongo');
// $mongo = new Mongo('mongodb://xingzhe:xingzhe2015@192.168.1.102:26001');
//加上要连接的数据库才不会再报no authentication认证失败的错误
$mongo = new Mongo('mongodb://xingzhe:xingzhe2015@192.168.1.102:26001/location');
// echo $mongo->connect();
// $mongo->selectDB('location')->selectCollection('bar.baz');
// $mongo->insert(array("name" => "Joe", "age" => 20), true);
// print_r($mongo->listDBs());
// print_r($mongo->execute('show dbs'));
$db = $mongo->location; //等同于selectDB: 数据库需要在mongo shell里预创建
$collection = $db->abc; //等同于selectCollection
// $result = $collection->findOne();
// print_r($mongo->location->site->findOne());
$result = $collection->insert(array("name" => "Joe1", "age" => 20));
var_dump($result);