<?php
class DeleteAction extends CAction{
    public function run(){
     	$id = Yii::app()->request->getParam('id');

     	$proxy = new BConference();   
     	$result = $proxy->deleteRoom($id);
     	echo CJSON::encode($result);
    }
}