<?php
class BasicInfoAction extends CAction{
	public function run(){
<<<<<<< HEAD
		// $order = new COrder;
  //       $result = $order->getlist();
  //       print_r($result);die;
=======
>>>>>>> 37831874bd6d1379ae5b029c57f8e633188887e9
		if(Yii::app()->user->isGuest) {
			$this->controller->render('basicInfo');
		} else {
			$this->controller->redirect('/payment/wxpay/jsapi/');
		}
	}
}