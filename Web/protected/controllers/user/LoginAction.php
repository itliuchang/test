<?php
class LoginAction extends CAction{

	public function run(){
		$this->controller->pageTitle='Login';
		if(Yii::app()->user->isGuest){
			if(Yii::app()->request->isAjaxRequest){
				$mobile = Yii::app()->request->getParam('mobile');
				$code = Yii::app()->request->getParam('code');

				$email = Yii::app()->request->getParam('email');
				$password = Yii::app()->request->getParam('password');
				
				$bind = Yii::app()->request->getParam('bind');

				$_identity = new UserIdentity();
				if ($mobile) {
					Yii::log($code,CLogger::LEVEL_ERROR);
					$_identity->authMobile($mobile, $code, $bind);
					if($_identity->errorCode === UserIdentity::ERROR_NONE){
						$duration = 86400;
						Yii::app()->user->login($_identity, $duration);
						echo CJSON::encode(array('code'=>200,'message'=>'success'));
						//$this->controller->redirect(Yii::app()->user->getReturnUrl(Assist::getDefaultURL()));
					} elseif ($_identity->errorCode === UserIdentity::ERROR_CODE_INVALID){
						echo CJSON::encode(array('code'=>500, 'message'=> '验证码不正确'));
                    } elseif ($_identity->errorCode === UserIdentity::ERROR_MOBILE_INVALID){
                    	echo CJSON::encode(array('code'=>500, 'message'=> '手机号未注册'));
                    } else {
                    	echo CJSON::encode(array('code'=>500, 'message'=> '登录错误'));
                    }
				} elseif ($email) {
					$_identity->authMail($email, $password, $bind);
					if($_identity->errorCode === UserIdentity::ERROR_NONE){
						$duration = 86400;
						Yii::app()->user->login($_identity, $duration);
						echo CJSON::encode(array('code'=>200,'message'=>'success'));
						//$this->controller->redirect(Assist::getDefaultURL());
						//$this->controller->redirect(Yii::app()->user->getReturnUrl(Assist::getDefaultURL()));
					} elseif ($_identity->errorCode === UserIdentity::ERROR_MAIL_INVALID){
						echo CJSON::encode(array('code'=>500, 'message'=> '邮箱未注册'));
					} elseif ($_identity->errorCode === UserIdentity::ERROR_PASSWORD_INVALID){
						echo CJSON::encode(array('code'=>500, 'message'=> '密码错误'));
					} else {
						echo CJSON::encode(array('code'=>500, 'message'=> '登录错误'));
					}
				} else {
					throw new CHttpException('405', '参数错误');
				}
			} else {
				$this->controller->render('login');
			}
		}else{
			$this->controller->redirect(Assist::getDefaultURL());
		}
	}

}