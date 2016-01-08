<?php
class AccessAction extends CAction{
	public function run(){
		if(Yii::app()->user->isGuest){
			$user = Yii::app()->session['user'];
			$identity = new UserIdentity($user);
			$identity->registAuth($user);
			$duration = Yii::app()->getComponent('session')->getTimeout();
			Yii::app()->user->login($identity, $duration);
			// Yii::log(print_r($user,1), CLogger::LEVEL_ERROR,'222');
			$tuser = User::model()->findByAttributes(array('id'=>$user['id']));
			$tuser->status = 1;
			$tuser->save();
			$this->controller->redirect('/user/updateProfile');
		}else{
			$tem = User::model()->findByAttributes(array('id'=>Yii::app()->user->id));
			$status = $tem->status;
			// Yii::log($status, CLogger::LEVEL_ERROR,'status');
			switch ($status) {
				case 1:
					$this->controller->redirect('/user/updateProfile');
					break;
				case 2:
					$this->controller->redirect('/company/updateProfile');
				default:
					$this->controller->redirect(Assist::getDefaultURL());
					break;
			}
			
		}
	}
}