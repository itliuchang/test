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
					$user= User::model()->findByAttributes(array('id'=>Yii::app()->user->id));
					Yii::log($user->portrait, CLogger::LEVEL_ERROR,'fir');
					Yii::app()->user->setState('portrait',$user->portrait);
					Yii::log(Yii::app()->user->getState('portrait'), CLogger::LEVEL_ERROR,'sec');
					// $_identity= new UserIdentity();
					// $_identity->setPersistentStates($user);
					// $duration = Yii::app()->getComponent('session')->getTimeout();
					// Yii::app()->user->login($_identity,$duration);
					$this->controller->redirect(Assist::getDefaultURL());
					break;
			}
			
		}
	}
}