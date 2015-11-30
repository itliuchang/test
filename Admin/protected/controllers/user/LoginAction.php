<?php
class LoginAction extends CAction{
	
	private $_identity;

	public function run(){
		if(Yii::app()->user->isGuest){
			if(Yii::app()->request->isAjaxRequest){
				$username = Yii::app()->request->getParam('username');
				$password = Yii::app()->request->getParam('password');

				$this->_identity = new UserIdentity();
				$this->_identity->authenticateAdmin($username, $password);
				if($this->_identity->errorCode === UserIdentity::ERROR_NONE){
					$duration = Yii::app()->getComponent('session')->getTimeout();
					Yii::app()->user->login($this->_identity, $duration);
					echo CJSON::encode(array('code' => 200, 'returnurl' => Yii::app()->user->getReturnUrl('/')));
				} else if ($this->_identity->errorCode === UserIdentity::ERROR_NOT_DAREN_ROLE) {
					echo CJSON::encode(array('code' => 403, 'message' => '您不是达人用户！'));
				} else {
					echo CJSON::encode(array('code' => 412, 'message' => '用户名或密码错误！'));
				}
			} else {
				$this->controller->pageTitle = '登录 - 悠游达人管理平台';
	        	$this->controller->layout = '//layouts/default-mini';
	        	$this->controller->render('login', array(
	        		'appid' => Yii::app()->params['partner']['wechat']['appid']		
	        	));
			}
		} else {
			if(Yii::app()->request->isAjaxRequest){
				echo CJSON::encode(array('code' => 200, 'returnurl' => Yii::app()->user->getReturnUrl('/')));
			}else{
				$this->controller->redirect(Yii::app()->user->getReturnUrl('/'));
			}
		}
	}
}