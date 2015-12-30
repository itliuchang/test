<?php
class LogoutAction extends CAction{
	
	public function run(){
		if(!Yii::app()->user->isGuest){
			$wechat = Account::model()->findByAttributes(array('account'=>Yii::app()->session['wechat']['unionid'],'status'=>1));
			if(Yii::app()->session['wechat']&&!empty($wechat)){
				$wechat->status=0;
				$wechat->save();
			}
			Yii::app()->session['wechat']=null;
			$_identity = new UserIdentity();
			$_identity->logout();
			Yii::log(Yii::app()->user->isGuest, CLogger::LEVEL_TRACE|LEVEL_WARNING|LEVEL_ERROR|LEVEL_INFO|LEVEL_PROFILE,'info');
			$this->controller->redirect('/registered/');
		}
	}

}