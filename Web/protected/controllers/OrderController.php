<?php
class OrderController extends Controller{
	public function actionIndex(){
		$productType = Yii::app()->request->getParam('type');
		$productName = Yii::app()->request->getParam('name');
		$productNum = Yii::app()->request->getParam('num');
		$productPrice = Yii::app()->request->getParam('price');
		$this->bodyCss='orderDetail';
		$this->render('index',array(
				'type' => $productType,
				'name' => $productName,
				'num' => $productNum,
				'price' => $productPrice,
			));
	}
}