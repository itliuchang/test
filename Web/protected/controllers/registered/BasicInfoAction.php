<?php
class BasicInfoAction extends CAction{
	public function run(){
			$order = new CReservation;
       $result = $order->getupcomingRes(1000);
       print_r($result);die;
		if(Yii::app()->user->isGuest) {
			$this->controller->render('basicInfo');
		} else {
			$this->controller->redirect('/payment/wxpay/jsapi/');
		}
	}
}