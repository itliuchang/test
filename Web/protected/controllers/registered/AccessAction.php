<?php
class AccessAction extends CAction{
	public function run(){
		if(Yii::app()->user->isGuest){
			$user = Yii::app()->session['user'];
			$identity = new UserIdentity($user);
			$identity->registAuth($user);
			$duration = Yii::app()->getComponent('session')->getTimeout();
			Yii::app()->user->login($identity, $duration);
			$tuser = User::model()->findByAttributes(array('id'=>$user->id));
			$tuser->status = 1;
			$tuser->save();
			$this->controller->redirect('/user/updateProfile');
		}else{
			$this->controller->redirect(Assist::getDefaultURL());
		}
	}
}