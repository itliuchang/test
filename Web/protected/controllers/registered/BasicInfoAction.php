<?php
class BasicInfoAction extends CAction{
	public function run(){
		Yii::app()->user->productType = Yii::app()->request->getParam('type');
		Yii::app()->user->productName = Yii::app()->request->getParam('name');
		Yii::app()->user->productNum = Yii::app()->request->getParam('num');
		Yii::app()->user->productPrice = Yii::app()->request->getParam('price');
		if(Yii::app()->user->isGuest) {
			$this->controller->render('basicInfo');
		} else {
			$this->controller->redirect('/payment/wxpay/jsapi/');
		}
	}
}