<?php
class LogoutAction extends CAction{
	
	public function run(){
		if(!Yii::app()->user->isGuest){
			if(Yii::app()->session['wechat']){
				Yii::app()->session['wechat']=null;
			}
			$_identity = new UserIdentity();
			$_identity->logout();
			$this->controller->redirect('/registered/');
		}
	}

}