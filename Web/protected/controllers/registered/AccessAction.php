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
			$type = $tem->type;
			if($type==1){
				switch ($status) {
					case 1:
						$this->controller->redirect('/user/updateProfile');
						break;
					default:
						$user= User::model()->findByAttributes(array('id'=>Yii::app()->user->id));
						Yii::app()->user->setState('portrait',$user->portrait);
						$this->controller->redirect(Assist::getDefaultURL());
						break;
				}
			}else if($type==2){
				switch ($status) {
					case 1:
						$this->controller->redirect('/user/updateProfile');
						break;
					default:
						$user= User::model()->findByAttributes(array('id'=>Yii::app()->user->id));
						Yii::app()->user->setState('portrait',$user->portrait);
						$this->controller->redirect(Assist::getDefaultURL());
						break;
				}
			}else if($type==3){
				switch ($status) {
					case 1:
						$this->controller->redirect('/user/updateProfile');
						break;
					case 2:
						$this->controller->redirect('/company/updateProfile');
						break;
					case 3:
						$this->controller->redirect('/registered/code');
						break;
					default:
						$user= User::model()->findByAttributes(array('id'=>Yii::app()->user->id));
						Yii::app()->user->setState('portrait',$user->portrait);
						$this->controller->redirect(Assist::getDefaultURL());
						break;
				}
			}
			// Yii::log($status, CLogger::LEVEL_ERROR,'status');
			// switch ($status) {
			// 	case 1:
			// 		$this->controller->redirect('/user/updateProfile');
			// 		break;
			// 	case 2:
			// 		$this->controller->redirect('/company/updateProfile');
			// 	case 21:
			// 		$this->controller->redirect('/user/updateProfile');
			// 	case 22:    
			// 		$this->controller->redirect('/user/updatecompany');
			// 	default:
			// 		$user= User::model()->findByAttributes(array('id'=>Yii::app()->user->id));
			// 		Yii::app()->user->setState('portrait',$user->portrait);
			// 		$this->controller->redirect(Assist::getDefaultURL());
			// 		break;
			// }
			
		}
	}
}