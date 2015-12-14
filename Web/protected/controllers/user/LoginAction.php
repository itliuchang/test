<?php
class LoginAction extends CAction{

	public function run(){
		if(Yii::app()->user->isGuest){
			if(Yii::app()->request->isAjaxRequest){
				$mobile = Yii::app()->request->getParam('mobile');
				$code = Yii::app()->request->getParam('code');

				$email = Yii::app()->request->getParam('email');
				$password = Yii::app()->request->getParam('$password');
								
			} else {
				$this->controller->render('login');
			}
		}else{
			$this->controller->redirect(Assist::getDefaultURL());
		}
	}

}