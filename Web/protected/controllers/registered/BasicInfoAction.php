<?php
class BasicInfoAction extends CAction{
	public function run(){
		if(Yii::app()->user->isGuest) {
			$this->controller->render('basicInfo');
		} else {
			$this->controller->redirect('/order');
		}
	}
}