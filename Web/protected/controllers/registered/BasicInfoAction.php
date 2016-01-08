<?php
class BasicInfoAction extends CAction{
	public function run(){
		if(Yii::app()->user->isGuest) {

			if (Yii::app()->session['user']) {
				$this->controller->redirect('/payment/wxpay/jsapi/');
			}else{
				$this->controller->pageTitle='Sign Up';
				$this->controller->render('basicInfo');
			}
		} else {
			$this->controller->redirect('/payment/wxpay/jsapi/');
		}
	}
}