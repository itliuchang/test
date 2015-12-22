<?php
class BasicInfoAction extends CAction{
	public function run(){
		// $order = new COrder;
  //      $result = $order->createProduct(array('orderId'=>154,'startDate'=>date('Ymd'),'endDate'=>date('Ymd',date('U')+2592000)));
  //      print_r($result);die;
		Yii::app()->user->setState('productType',Yii::app()->request->getParam('type'));
		Yii::app()->user->setState('productName' , Yii::app()->request->getParam('name'));
		Yii::app()->user->setState('productNum' , Yii::app()->request->getParam('num'));
		Yii::app()->user->setState('productPrice' , Yii::app()->request->getParam('price'));
		if(Yii::app()->user->isGuest) {
			$this->controller->render('basicInfo');
		} else {
			$this->controller->redirect('/payment/wxpay/jsapi/');
		}
	}
}