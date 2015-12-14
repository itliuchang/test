<?php
class LogoutAction extends CAction{
	
	public function run(){
		if(!Yii::app()->user->isGuest){
			$_identity = new UserIdentity();
			$_identity->logout();
		}
	}

}