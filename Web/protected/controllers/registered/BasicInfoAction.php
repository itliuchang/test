<?php
class BasicInfoAction extends CAction{
	public function run(){
			// $order = new COrder;
   //     $result = $order->getlist(1124);
   //     print_r($result);die;
		if(Yii::app()->user->isGuest) {
			$this->controller->render('basicInfo');
		} else {
			$this->controller->redirect('/payment/wxpay/jsapi/');
		}
	}
}