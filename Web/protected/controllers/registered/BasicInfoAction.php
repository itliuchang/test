<?php
class BasicInfoAction extends CAction{
	public function run(){
		$productType = Yii::app()->request->getParam('type');
		$productName = Yii::app()->request->getParam('name');
		$productNum = Yii::app()->request->getParam('num');
		$productPrice = Yii::app()->request->getParam('price');
		if(Yii::app()->user->isGuest) {
			$this->controller->render('basicInfo',array(
				'type' => $productType,
				'name' => $productName,
				'num' => $productNum,
				'price' => $productPrice,
			));
		} else {
			$this->controller->redirect('/order?type='.$productType.'&name='.$productName.'&num='.$productNum.'&price='.$productPrice);
		}
	}
}