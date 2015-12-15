<?php
class EditAction extends CAction{
    public function run(){
        $id = Yii::app()->request->getParam('id');
        $name = Yii::app()->request->getParam('name');
        $hub = Yii::app()->request->getParam('hub');
        $price = Yii::app()->request->getParam('price');
        $seats = Yii::app()->request->getParam('seats');
        $floor = Yii::app()->request->getParam('floor');
        $background = Yii::app()->request->getParam('background');

        $data = array(
        	'name' => $name,
        	'hubId' => $hub,
        	'price' => $price,
        	'seats' => $seats,
        	'floor' => $floor,
        	'background' => $background
        );
        $proxy = new BConference();
        $dp = new Hubs;
        if(Yii::app()->request->isAjaxRequest){
        	$result = $proxy->updateRoom($data,$id);
        	echo CJSON::encode($result);
        } else {
        	$hub = $dp->getHub();
        	$result = $proxy->getRoomInfo($id);
        	$this->controller->render('edit',array(
        		'data'=>$result['data'],
        		'hub'=>$hub
        	));
        }
    }
}