<?php
class BasicInfoAction extends CAction{
	public function run(){
		$this->controller->pageTitle ="Sigin Up";
		if(Yii::app()->user->isGuest) {
			if (Yii::app()->session['user']) {
				$this->controller->redirect('/payment/wxpay/jsapi/');
			}else{
				$this->controller->render('basicInfo');
			}
		} else {
			$this->controller->redirect('/payment/wxpay/jsapi/');
		}
	}
}