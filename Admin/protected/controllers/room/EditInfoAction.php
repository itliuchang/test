<?php
class EditInfoAction extends CAction{
    public function run(){
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
        $result = $proxy->createRoom($data);
        if($result['code']==200){
            $this->controller->redirect('/room/list');
        } else {
            throw new CHttpException($result['code'], $result['message']);
        }
    }
}